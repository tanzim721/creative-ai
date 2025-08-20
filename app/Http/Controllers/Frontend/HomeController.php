<?php

namespace App\Http\Controllers\Frontend;

use Stripe\Stripe;
use App\Models\Plan;
use App\Models\User;
use Stripe\Customer;
use Stripe\PaymentIntent;
use App\Models\PaymentLog;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Stripe\Checkout\Session;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $plans = Plan::where('is_active', 1)->get();

        $mongpTestdata = DB::connection('mongodb')->collection('test')->get();
dd($mongpTestdata);


        return view('welcome', compact('plans'));
    }
    public function textGenerate(Request $request)
    {
        $request->validate([
            'prompt' => 'required|string|max:200'
        ]);

        $apiKey = env('GEMINI_API_KEY');

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'X-goog-api-key' => $apiKey,
        ])->post('https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent', [
            'contents' => [
                [
                    'parts' => [
                        [
                            'text' => $request->input('prompt')
                        ]
                    ]
                ]
            ]
        ])->json();

        $aiText = $response['candidates'][0]['content']['parts'][0]['text'] ?? 'No response from AI';
        
        return view('welcome', [
            'plans' => Plan::where('is_active', 1)->get(),
            'data' => ['data' => $aiText]
        ]);
    }


    public function checkout(Request $request, $plan_id)
    {
        $plan = Plan::findOrFail($plan_id);
        $user = auth()->user();
        $billingCycle = $request->get('billing_cycle', 'monthly'); // monthly or yearly

        Stripe::setApiKey(config('services.stripe.secret'));

        // Create or get Stripe customer
        $customer = $this->createOrGetCustomer($user);

        // Determine price based on billing cycle
        $price = $billingCycle === 'yearly' ? $plan->yearly_price : $plan->monthly_price;
        $stripePriceId = $billingCycle === 'yearly' ? $plan->stripe_price_id_yearly : $plan->stripe_price_id_monthly;

        if ($stripePriceId) {
            // Use Stripe subscription mode for auto-renewal
            $session = Session::create([
                'customer' => $customer->id,
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price' => $stripePriceId,
                    'quantity' => 1,
                ]],
                'mode' => 'subscription',
                'success_url' => route('payment.success') . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('payment.cancel'),
                'metadata' => [
                    'user_id' => $user->id,
                    'plan_id' => $plan->id,
                    'billing_cycle' => $billingCycle,
                ],
                // Allow promotion codes
                'allow_promotion_codes' => true,
                // Collect billing address for better fraud prevention
                'billing_address_collection' => 'required',
            ]);
        } else {
            // Fallback to one-time payment
            $session = Session::create([
                'customer' => $customer->id,
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => $plan->name . ' (' . ucfirst($billingCycle) . ')',
                        ],
                        'unit_amount' => $price * 100,
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                'success_url' => route('payment.success') . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('payment.cancel'),
                'metadata' => [
                    'user_id' => $user->id,
                    'plan_id' => $plan->id,
                    'billing_cycle' => $billingCycle,
                ],
                'billing_address_collection' => 'required',
            ]);
        }

        return redirect($session->url);
    }

    public function success(Request $request)
    {
        $session_id = $request->get('session_id');

        if (!$session_id) {
            return redirect()->route('login')->with('error', 'Invalid session.');
        }

        try {
            Stripe::setApiKey(config('services.stripe.secret'));
            $session = Session::retrieve($session_id, [
                'expand' => ['payment_intent', 'subscription', 'payment_intent.payment_method']
            ]);

            $user_id = $session->metadata->user_id;
            $plan_id = $session->metadata->plan_id;
            $billing_cycle = $session->metadata->billing_cycle ?? 'monthly';

            // Verify user authorization
            if (auth()->id() != $user_id) {
                return redirect()->route('login')->with('error', 'Unauthorized access.');
            }

            // Extract card details with better error handling
            $cardDetails = $this->extractCardDetailsFromSession($session);
            Log::info('Card details extracted:', $cardDetails);

            // Calculate expiration date based on billing cycle
            $expiresAt = $billing_cycle === 'yearly' ? now()->addYear() : now()->addMonth();
            
            // Determine transaction type and get subscription ID if applicable
            $transactionType = $session->mode === 'subscription' ? 'one_time' : 'auto_renew';
            $stripeSubscriptionId = null;
            
            if ($session->mode === 'subscription' && $session->subscription) {
                $stripeSubscriptionId = is_string($session->subscription) 
                    ? $session->subscription 
                    : $session->subscription->id;
            }
            
            // Check if subscription already exists to avoid duplicates
            $existingSubscription = Subscription::where('payment_id', $session_id)->first();
            
            if (!$existingSubscription) {
                // Store subscription
                Subscription::create([
                    'user_id' => $user_id,
                    'plan_id' => $plan_id,
                    'billing_cycle' => $billing_cycle,
                    'starts_at' => now(),
                    'expires_at' => $expiresAt,
                    'amount_paid' => $session->amount_total / 100,
                    'status' => 'active',
                    'payment_method' => 'stripe',
                    'payment_id' => $session_id,
                    'stripe_subscription_id' => $stripeSubscriptionId,
                ]);
            }

            // Check if payment log already exists
            $existingPaymentLog = PaymentLog::where('session_id', $session_id)->first();
            
            if (!$existingPaymentLog) {
                // Log payment success with card details
                PaymentLog::create([
                    'user_id' => $user_id,
                    'plan_id' => $plan_id,
                    'session_id' => $session_id,
                    'amount' => $session->amount_total / 100,
                    'status' => 'success',
                    'payment_method' => 'stripe',
                    'card_last_4' => $cardDetails['last4'] ?? null,
                    'card_brand' => $cardDetails['brand'] ?? null,
                    'stripe_subscription_id' => $stripeSubscriptionId,
                    'transaction_type' => $transactionType
                ]);
                
                Log::info('Payment log created with card last 4: ' . ($cardDetails['last4'] ?? 'null'));
            }

            // Update user role
            $user = User::find($user_id);
            if ($user) {
                $user->role = $plan_id ? 1 : 0;
                $user->save();
            }

            return redirect()->route('login')->with('success', 'Payment successful! Your subscription has been activated.');
            
        } catch (\Exception $e) {
            Log::error('Payment success handling failed: ' . $e->getMessage());
            return redirect()->route('login')->with('error', 'Payment processing failed. Please contact support.');
        }
    }

    public function cancel(Request $request)
    {
        $session_id = $request->get('session_id');

        // Log cancellation (if user logged in)
        if (auth()->check()) {
            PaymentLog::create([
                'user_id' => auth()->id(),
                'plan_id' => null,
                'session_id' => $session_id,
                'amount' => null,
                'status' => 'cancelled',
                'payment_method' => 'stripe',
                'transaction_type' => 'cancelled'
            ]);
        }

        return redirect()->route('login')->with('error', 'Payment cancelled.');
    }

    // Helper methods
    private function createOrGetCustomer($user)
    {
        if ($user->stripe_customer_id) {
            try {
                return Customer::retrieve($user->stripe_customer_id);
            } catch (\Exception $e) {
                // Customer not found, create new one
                Log::warning('Stripe customer not found, creating new: ' . $e->getMessage());
            }
        }

        try {
            $customer = Customer::create([
                'email' => $user->email,
                'name' => $user->name,
                'metadata' => ['user_id' => $user->id]
            ]);

            $user->update(['stripe_customer_id' => $customer->id]);
            return $customer;
            
        } catch (\Exception $e) {
            Log::error('Failed to create Stripe customer: ' . $e->getMessage());
            throw $e;
        }
    }

    private function extractCardDetailsFromSession($session)
    {
        try {
            Log::info('Extracting card details from session mode: ' . $session->mode);
            
            // For payment mode (one-time payments)
            if ($session->mode === 'payment' && $session->payment_intent) {
                $paymentIntentId = is_string($session->payment_intent) 
                    ? $session->payment_intent 
                    : $session->payment_intent->id;
                    
                Log::info('Retrieving payment intent: ' . $paymentIntentId);
                
                $paymentIntent = PaymentIntent::retrieve($paymentIntentId, [
                    'expand' => ['charges.data.payment_method_details', 'payment_method']
                ]);
                
                // Try to get card details from charges
                if (isset($paymentIntent->charges->data[0])) {
                    $charge = $paymentIntent->charges->data[0];
                    if (isset($charge->payment_method_details->card)) {
                        $card = $charge->payment_method_details->card;
                        Log::info('Card details found in charges: ' . $card->last4);
                        return [
                            'last4' => $card->last4,
                            'brand' => $card->brand,
                            'exp_month' => $card->exp_month ?? null,
                            'exp_year' => $card->exp_year ?? null,
                            'funding' => $card->funding ?? null,
                            'country' => $card->country ?? null,
                        ];
                    }
                }
                
                // Try to get card details from payment method
                if ($paymentIntent->payment_method) {
                    $paymentMethodId = is_string($paymentIntent->payment_method) 
                        ? $paymentIntent->payment_method 
                        : $paymentIntent->payment_method->id;
                        
                    $paymentMethod = \Stripe\PaymentMethod::retrieve($paymentMethodId);
                    if (isset($paymentMethod->card)) {
                        $card = $paymentMethod->card;
                        Log::info('Card details found in payment method: ' . $card->last4);
                        return [
                            'last4' => $card->last4,
                            'brand' => $card->brand,
                            'exp_month' => $card->exp_month ?? null,
                            'exp_year' => $card->exp_year ?? null,
                            'funding' => $card->funding ?? null,
                            'country' => $card->country ?? null,
                        ];
                    }
                }
            }

            // For subscription mode
            if ($session->mode === 'subscription') {
                // Try to get the subscription and its default payment method
                if ($session->subscription) {
                    $subscriptionId = is_string($session->subscription) 
                        ? $session->subscription 
                        : $session->subscription->id;
                        
                    Log::info('Retrieving subscription: ' . $subscriptionId);
                    
                    $subscription = \Stripe\Subscription::retrieve($subscriptionId, [
                        'expand' => ['default_payment_method']
                    ]);
                    
                    if ($subscription->default_payment_method && isset($subscription->default_payment_method->card)) {
                        $card = $subscription->default_payment_method->card;
                        Log::info('Card details found in subscription payment method: ' . $card->last4);
                        return [
                            'last4' => $card->last4,
                            'brand' => $card->brand,
                            'exp_month' => $card->exp_month ?? null,
                            'exp_year' => $card->exp_year ?? null,
                            'funding' => $card->funding ?? null,
                            'country' => $card->country ?? null,
                        ];
                    }
                }

                // Try to get card details from setup intent (for subscription)
                if ($session->setup_intent) {
                    $setupIntentId = is_string($session->setup_intent) 
                        ? $session->setup_intent 
                        : $session->setup_intent->id;
                        
                    Log::info('Retrieving setup intent: ' . $setupIntentId);
                    
                    $setupIntent = \Stripe\SetupIntent::retrieve($setupIntentId);
                    
                    if ($setupIntent->payment_method) {
                        $paymentMethod = \Stripe\PaymentMethod::retrieve($setupIntent->payment_method);
                        if (isset($paymentMethod->card)) {
                            $card = $paymentMethod->card;
                            Log::info('Card details found in setup intent: ' . $card->last4);
                            return [
                                'last4' => $card->last4,
                                'brand' => $card->brand,
                                'exp_month' => $card->exp_month ?? null,
                                'exp_year' => $card->exp_year ?? null,
                                'funding' => $card->funding ?? null,
                                'country' => $card->country ?? null,
                            ];
                        }
                    }
                }
            }
            
            Log::warning('No card details found in session');
            
        } catch (\Exception $e) {
            Log::error('Failed to extract card details from session: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
        }

        return [];
    }

}