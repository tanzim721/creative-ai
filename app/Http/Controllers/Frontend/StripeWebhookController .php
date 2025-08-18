<?php

namespace App\Http\Controllers\Frontend;

use Stripe\Stripe;
use App\Models\User;
use App\Models\Subscription;
use App\Models\PaymentLog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Stripe\Webhook;
use Stripe\PaymentIntent;
use Illuminate\Support\Facades\Log;

class StripeWebhookController extends Controller
{
    public function handle(Request $request)
    {
        Stripe::setApiKey(config('services.stripe.secret'));
        
        $payload = $request->getContent();
        $sig_header = $request->header('Stripe-Signature');
        $endpoint_secret = config('services.stripe.webhook_secret');

        try {
            $event = Webhook::constructEvent($payload, $sig_header, $endpoint_secret);
        } catch (\UnexpectedValueException $e) {
            Log::error('Invalid payload: ' . $e->getMessage());
            return response('Invalid payload', 400);
        } catch (\Stripe\Exception\SignatureVerificationException $e) {
            Log::error('Invalid signature: ' . $e->getMessage());
            return response('Invalid signature', 400);
        }

        // Handle the event
        switch ($event->type) {
            case 'invoice.payment_succeeded':
                $this->handleSuccessfulPayment($event->data->object);
                break;
                
            case 'invoice.payment_failed':
                $this->handleFailedPayment($event->data->object);
                break;
                
            case 'customer.subscription.updated':
                $this->handleSubscriptionUpdated($event->data->object);
                break;
                
            case 'customer.subscription.deleted':
                $this->handleSubscriptionCanceled($event->data->object);
                break;
                
            default:
                Log::info('Unhandled event type: ' . $event->type);
        }

        return response('Webhook handled', 200);
    }

    private function handleSuccessfulPayment($invoice)
    {
        try {
            $subscription = Subscription::where('stripe_subscription_id', $invoice->subscription)->first();
            
            if (!$subscription) {
                Log::warning('Subscription not found for invoice: ' . $invoice->id);
                return;
            }

            // Get card details from payment intent
            $cardDetails = $this->getCardDetailsFromInvoice($invoice);
            
            // Determine if this is initial payment or renewal
            $isRenewal = $subscription->status === 'active';
            
            if ($isRenewal) {
                // Update subscription expiration date
                $newExpiresAt = $subscription->billing_cycle === 'yearly' 
                    ? $subscription->expires_at->addYear() 
                    : $subscription->expires_at->addMonth();
                    
                $subscription->update([
                    'expires_at' => $newExpiresAt,
                    'status' => 'active'
                ]);
            }

            // Log the payment
            PaymentLog::create([
                'user_id' => $subscription->user_id,
                'plan_id' => $subscription->plan_id,
                'session_id' => null,
                'amount' => $invoice->amount_paid / 100,
                'status' => 'success',
                'payment_method' => 'stripe',
                'card_last_4' => $cardDetails['last4'] ?? null,
                'card_brand' => $cardDetails['brand'] ?? null,
                'stripe_subscription_id' => $invoice->subscription,
                'transaction_type' => $isRenewal ? 'renewal' : 'subscription'
            ]);

            Log::info('Payment processed successfully for subscription: ' . $invoice->subscription);
            
        } catch (\Exception $e) {
            Log::error('Error handling successful payment: ' . $e->getMessage());
        }
    }

    private function handleFailedPayment($invoice)
    {
        try {
            $subscription = Subscription::where('stripe_subscription_id', $invoice->subscription)->first();
            
            if (!$subscription) {
                Log::warning('Subscription not found for failed payment: ' . $invoice->id);
                return;
            }

            // Update subscription status
            $subscription->update(['status' => 'past_due']);

            // Log the failed payment
            PaymentLog::create([
                'user_id' => $subscription->user_id,
                'plan_id' => $subscription->plan_id,
                'session_id' => null,
                'amount' => $invoice->amount_due / 100,
                'status' => 'failed',
                'payment_method' => 'stripe',
                'stripe_subscription_id' => $invoice->subscription,
                'transaction_type' => 'renewal'
            ]);

            // Optionally downgrade user role
            $user = User::find($subscription->user_id);
            if ($user) {
                $user->update(['role' => 0]); // Downgrade to free user
            }

            Log::info('Payment failed for subscription: ' . $invoice->subscription);
            
        } catch (\Exception $e) {
            Log::error('Error handling failed payment: ' . $e->getMessage());
        }
    }

    private function handleSubscriptionUpdated($stripeSubscription)
    {
        try {
            $subscription = Subscription::where('stripe_subscription_id', $stripeSubscription->id)->first();
            
            if (!$subscription) {
                Log::warning('Subscription not found for update: ' . $stripeSubscription->id);
                return;
            }

            // Update subscription status based on Stripe status
            $status = $this->mapStripeStatus($stripeSubscription->status);
            $subscription->update(['status' => $status]);

            Log::info('Subscription updated: ' . $stripeSubscription->id . ' - Status: ' . $status);
            
        } catch (\Exception $e) {
            Log::error('Error handling subscription update: ' . $e->getMessage());
        }
    }

    private function handleSubscriptionCanceled($stripeSubscription)
    {
        try {
            $subscription = Subscription::where('stripe_subscription_id', $stripeSubscription->id)->first();
            
            if (!$subscription) {
                Log::warning('Subscription not found for cancellation: ' . $stripeSubscription->id);
                return;
            }

            // Update subscription status
            $subscription->update(['status' => 'canceled']);

            // Log the cancellation
            PaymentLog::create([
                'user_id' => $subscription->user_id,
                'plan_id' => $subscription->plan_id,
                'session_id' => null,
                'amount' => null,
                'status' => 'cancelled',
                'payment_method' => 'stripe',
                'stripe_subscription_id' => $stripeSubscription->id,
                'transaction_type' => 'cancelled'
            ]);

            // Downgrade user role
            $user = User::find($subscription->user_id);
            if ($user) {
                $user->update(['role' => 0]);
            }

            Log::info('Subscription canceled: ' . $stripeSubscription->id);
            
        } catch (\Exception $e) {
            Log::error('Error handling subscription cancellation: ' . $e->getMessage());
        }
    }

    private function getCardDetailsFromInvoice($invoice)
    {
        try {
            if ($invoice->payment_intent) {
                $paymentIntent = PaymentIntent::retrieve($invoice->payment_intent);
                
                if (isset($paymentIntent->charges->data[0])) {
                    $charge = $paymentIntent->charges->data[0];
                    if (isset($charge->payment_method_details->card)) {
                        $card = $charge->payment_method_details->card;
                        return [
                            'last4' => $card->last4,
                            'brand' => $card->brand,
                            'exp_month' => $card->exp_month,
                            'exp_year' => $card->exp_year,
                        ];
                    }
                }
            }
        } catch (\Exception $e) {
            Log::error('Failed to extract card details from invoice: ' . $e->getMessage());
        }

        return [];
    }

    private function mapStripeStatus($stripeStatus)
    {
        $statusMap = [
            'active' => 'active',
            'past_due' => 'past_due',
            'canceled' => 'canceled',
            'unpaid' => 'past_due',
            'incomplete' => 'pending',
            'incomplete_expired' => 'canceled',
            'trialing' => 'active'
        ];

        return $statusMap[$stripeStatus] ?? 'unknown';
    }
}