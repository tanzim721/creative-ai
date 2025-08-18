<?php

namespace App\Http\Controllers\Admin;

use App\Models\Plan;
use App\Models\PaymentLog;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BillingController extends Controller
{
    
    public function overview()
    {         
        $subscription = Subscription::where('user_id', Auth::user()->id)->latest()->first();
        $paymentLogs = PaymentLog::where('user_id', Auth::user()->id)->latest()->paginate(10);
        $plans = Plan::where('is_active', 1)->get(); 
        return view('creatives_test.billing.index', compact('subscription', 'paymentLogs', 'plans'));
    }

    public function cancel(Request $request)
    {

        $subscription = Subscription::where('user_id', Auth::user()->id)->where('status', 'active')->latest()->first();

        if (!$subscription) {
            return back()->with('error', 'No active subscription found.');
        }

        try {
            $subscription->update(['status' => 'canceled']);

            

            return back()->with('success', 'Subscription has been canceled successfully.');
            
        } catch (\Exception $e) {
            \Log::error('Subscription cancellation failed: ' . $e->getMessage());
            return back()->with('error', 'Failed to cancel subscription. Please try again.');
        }
    }

    public function resume(Request $request)
    {

        $subscription = Subscription::where('user_id', Auth::user()->id)->where('status', 'canceled')->where('expires_at', '>', now())->latest()->first();

        if (!$subscription) {
            return back()->with('error', 'No eligible subscription found to resume.');
        }

        try {
            // This would require creating a new subscription as Stripe doesn't allow resuming canceled subscriptions
            // Redirect to checkout instead
            $subscription->update(['status' => 'active']);

            return back()->with('success', 'Subscription has been resumed successfully.');
            
        } catch (\Exception $e) {
            \Log::error('Subscription resume failed: ' . $e->getMessage());
            return back()->with('error', 'Failed to resume subscription. Please try again.');
        }
    }

}
