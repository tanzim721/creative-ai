<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Plan;
use App\Models\User;
use App\Models\PromoCode;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Services\SubscriptionService;
use Illuminate\Support\Facades\Validator;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the subscriptions.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // Check and update expired subscriptions based on date
        $this->checkExpiredSubscriptions();
        
        // Check and update expired subscriptions based on download limits
        $this->checkDownloadLimits();
        
        $query = Subscription::with(['user', 'plan']);

        // Handle search filter
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Handle status filter
        if ($request->has('status') && !empty($request->status)) {
            $query->where('status', $request->status);
        }

        // Handle billing cycle filter
        if ($request->has('billing_cycle') && !empty($request->billing_cycle)) {
            $query->where('billing_cycle', $request->billing_cycle);
        }

        // Handle plan filter
        if ($request->has('plan_id') && !empty($request->plan_id)) {
            $query->where('plan_id', $request->plan_id);
        }

        $subscriptions = $query->orderBy('created_at', 'desc')->paginate(10);
        $plans = Plan::all();

        return view('super_admin.subscriptions.index', compact('subscriptions', 'plans'));
    }

    /**
     * Check for expired subscriptions based on expiration date and update their status
     *
     * @return void
     */
    public function checkExpiredSubscriptions()
    {
        $now = Carbon::now();
        
        // Find active subscriptions that have expired
        $expiredSubscriptions = Subscription::where('status', 'active')
            ->whereNotNull('expires_at')
            ->where('expires_at', '<', $now)
            ->get();
            
        // Update their status to expired
        foreach ($expiredSubscriptions as $subscription) {
            $subscription->update(['status' => 'expired']);
        }
    }
    
    /**
     * Check if subscriptions have exceeded their download limits based on billing cycle
     * and update their status accordingly
     *
     * @return void
     */
    public function checkDownloadLimits()
    {
        // Get all active subscriptions with their associated plans
        $activeSubscriptions = Subscription::with('plan')
            ->where('status', 'active')
            ->get();
            
        foreach ($activeSubscriptions as $subscription) {
            // Skip if plan isn't loaded
            if (!$subscription->plan) {
                continue;
            }
            
            $downloadLimit = 0;
            
            // Get the appropriate download limit based on billing cycle
            if ($subscription->billing_cycle === 'monthly') {
                $downloadLimit = $subscription->plan->monthly_download_limit;
            } elseif ($subscription->billing_cycle === 'yearly') {
                $downloadLimit = $subscription->plan->yearly_download_limit;
            }
            
            // If downloads used exceeds the limit, expire the subscription
            if ($downloadLimit > 0 && $subscription->downloads_used >= $downloadLimit) {
                $subscription->update(['status' => 'expired']);
            }
        }
    }

    /**
     * Show the form for creating a new subscription.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $users = User::all();
        $plans = Plan::all();
        // dd($users);
        return view('super_admin.subscriptions.create', compact('users', 'plans'));
    }

    /**
     * Store a newly created subscription in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'plan_id' => 'required|exists:plans,id',
            'billing_cycle' => 'required|in:monthly,yearly',
            'starts_at' => 'required|date',
            'expires_at' => 'nullable|date|after:starts_at',
            'amount_paid' => 'required|numeric|min:0',
            'downloads_used' => 'required|integer|min:0',
            'status' => 'required|in:active,expired,canceled',
            'payment_method' => 'nullable|string',
            'payment_id' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        Subscription::create($request->all());

        return redirect()->route('subscriptions.index')
            ->with('success', 'Subscription created successfully.');
    }

    /**
     * Display the specified subscription.
     *
     * @param  \App\Models\Subscription  $subscription
     * @return \Illuminate\View\View
     */
    public function show(Subscription $subscription)
    {
        $subscription->load(['user', 'plan']);
        return view('super_admin.subscriptions.show', compact('subscription'));
    }

    /**
     * Show the form for editing the specified subscription.
     *
     * @param  \App\Models\Subscription  $subscription
     * @return \Illuminate\View\View
     */
    public function edit(Subscription $subscription)
    {
        $users = User::all();
        $plans = Plan::all();
        return view('super_admin.subscriptions.edit', compact('subscription', 'users', 'plans'));
    }

    /**
     * Update the specified subscription in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subscription  $subscription
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Subscription $subscription)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'plan_id' => 'required|exists:plans,id',
            'billing_cycle' => 'required|in:monthly,yearly',
            'starts_at' => 'required|date',
            'expires_at' => 'nullable|date|after:starts_at',
            'amount_paid' => 'required|numeric|min:0',
            'downloads_used' => 'required|integer|min:0',
            'status' => 'required|in:active,expired,canceled',
            'payment_method' => 'nullable|string',
            'payment_id' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $subscription->update($request->all());

        return redirect()->route('subscriptions.index')
            ->with('success', 'Subscription updated successfully.');
    }

    /**
     * Remove the specified subscription from storage.
     *
     * @param  \App\Models\Subscription  $subscription
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Subscription $subscription)
    {
        $subscription->delete();

        return redirect()->route('subscriptions.index')
            ->with('success', 'Subscription deleted successfully.');
    }
    
    /**
     * Cancel the specified subscription.
     *
     * @param  \App\Models\Subscription  $subscription
     * @return \Illuminate\Http\RedirectResponse
     */
    public function cancel(Subscription $subscription)
    {
        $subscription->update([
            'status' => 'canceled',
        ]);

        return redirect()->route('subscriptions.index')
            ->with('success', 'Subscription canceled successfully.');
    }
    
    /**
     * Renew the specified subscription.
     *
     * @param  \App\Models\Subscription  $subscription
     * @return \Illuminate\Http\RedirectResponse
     */
    public function renew(Request $request, Subscription $subscription)
    {
        $validator = Validator::make($request->all(), [
            'duration' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        
        $duration = (int) $request->duration; // Ensure duration is an integer
        $startsAt = Carbon::now();
        $expiresAt = $subscription->billing_cycle === 'monthly' ? 
            $startsAt->copy()->addMonths($duration) : 
            $startsAt->copy()->addYears($duration);
            
        $subscription->update([
            'starts_at' => $startsAt,
            'expires_at' => $expiresAt,
            'status' => 'active',
        ]);

        return redirect()->route('subscriptions.index')
            ->with('success', 'Subscription renewed successfully.');
    }
    
    /**
     * Manually check and update a specific subscription's status based on
     * expiration date and download limits
     *
     * @param  \App\Models\Subscription  $subscription
     * @return \App\Models\Subscription
     */
    public function checkSubscriptionStatus(Subscription $subscription)
    {
        // Check if the subscription has expired based on date
        if ($subscription->status === 'active' && 
            $subscription->expires_at && 
            Carbon::now()->gt($subscription->expires_at)) {
            $subscription->update(['status' => 'expired']);
            return $subscription->fresh();
        }
        
        // Check if the subscription has exceeded download limits
        if ($subscription->status === 'active' && $subscription->plan) {
            $downloadLimit = 0;
            
            if ($subscription->billing_cycle === 'monthly') {
                $downloadLimit = $subscription->plan->monthly_download_limit;
            } elseif ($subscription->billing_cycle === 'yearly') {
                $downloadLimit = $subscription->plan->yearly_download_limit;
            }
            
            if ($downloadLimit > 0 && $subscription->downloads_used >= $downloadLimit) {
                $subscription->update(['status' => 'expired']);
                return $subscription->fresh();
            }
        }
        
        return $subscription;
    }
}