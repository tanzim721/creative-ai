<?php

namespace App\Services;

use App\Models\Plan;
use App\Models\User;
use App\Models\Subscription;
use App\Models\PromoCode;

class SubscriptionService
{
    public function createSubscription(User $user, Plan $plan, $billingCycle, $paymentMethod = null, $paymentId = null, PromoCode $promoCode = null)
    {
        $originalPrice = $plan->getPrice($billingCycle);
        $discountAmount = 0;
        
        // Apply promo code if valid
        if ($promoCode && $promoCode->isValid()) {
            $discountAmount = $promoCode->calculateDiscount($originalPrice);
            
            // Increment used count for promo code
            $promoCode->increment('used_count');
        }
        
        $amountPaid = max(0, $originalPrice - $discountAmount);
        
        $startsAt = now();
        $expiresAt = $billingCycle === 'monthly' ? now()->addMonth() : now()->addYear();
        
        return Subscription::create([
            'user_id' => $user->id,
            'plan_id' => $plan->id,
            'billing_cycle' => $billingCycle,
            'starts_at' => $startsAt,
            'expires_at' => $expiresAt,
            'amount_paid' => $amountPaid,
            'downloads_used' => 0,
            'status' => 'active',
            'payment_method' => $paymentMethod,
            'payment_id' => $paymentId,
        ]);
    }
    
    public function renewSubscription(Subscription $subscription, $paymentMethod = null, $paymentId = null, PromoCode $promoCode = null)
    {
        // Similar to createSubscription but extends the current one
        $originalPrice = $subscription->plan->getPrice($subscription->billing_cycle);
        $discountAmount = 0;
        
        if ($promoCode && $promoCode->isValid()) {
            $discountAmount = $promoCode->calculateDiscount($originalPrice);
            $promoCode->increment('used_count');
        }
        
        $amountPaid = max(0, $originalPrice - $discountAmount);
        
        $startsAt = $subscription->expires_at ?? now();
        $expiresAt = $subscription->billing_cycle === 'monthly' 
            ? $startsAt->copy()->addMonth() 
            : $startsAt->copy()->addYear();
        
        $subscription->update([
            'starts_at' => $startsAt,
            'expires_at' => $expiresAt,
            'amount_paid' => $amountPaid,
            'downloads_used' => 0,
            'status' => 'active',
            'payment_method' => $paymentMethod ?? $subscription->payment_method,
            'payment_id' => $paymentId ?? $subscription->payment_id,
        ]);
        
        return $subscription;
    }
    
    public function cancelSubscription(Subscription $subscription)
    {
        return $subscription->update([
            'status' => 'canceled'
        ]);
    }
    
    public function validatePromoCode($code)
    {
        $promoCode = PromoCode::where('code', $code)
            ->where('is_active', true)
            ->first();
            
        if (!$promoCode) {
            return null;
        }
        
        if (!$promoCode->isValid()) {
            return null;
        }
        
        return $promoCode;
    }
}