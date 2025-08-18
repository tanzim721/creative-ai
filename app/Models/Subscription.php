<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subscription extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'plan_id',
        'billing_cycle',
        'starts_at',
        'expires_at',
        'amount_paid',
        'downloads_used',
        'status',
        'payment_method',
        'payment_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'starts_at' => 'datetime',
        'expires_at' => 'datetime',
        'amount_paid' => 'decimal:2',
    ];

    /**
     * Get the user that owns the subscription.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the plan that the subscription belongs to.
     */
    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    /**
     * Check if the subscription is active.
     *
     * @return bool
     */
    public function isActive()
    {
        return $this->status === 'active' && 
               ($this->expires_at === null || $this->expires_at->isFuture());
    }

    /**
     * Check if the subscription is expired.
     *
     * @return bool
     */
    public function isExpired()
    {
        return $this->status === 'expired' || 
               ($this->expires_at !== null && $this->expires_at->isPast());
    }

    /**
     * Check if the subscription is canceled.
     *
     * @return bool
     */
    public function isCanceled()
    {
        return $this->status === 'canceled';
    }
    
    /**
     * Get the subscription remaining days.
     *
     * @return int
     */
    public function getRemainingDays()
    {
        if ($this->expires_at === null) {
            return null;
        }
        
        return max(0, now()->diffInDays($this->expires_at, false));
    }
    
    /**
     * Get the formatted amount paid.
     *
     * @return string
     */
    public function getFormattedAmountPaid()
    {
        return '$' . number_format($this->amount_paid, 2);
    }
    public function hasDownloadsLeft()
    {
        // Free plan might have unlimited downloads or a limited number
        if ($this->plan->slug === 'free') {
            return $this->plan->monthly_download_limit === 0 || $this->downloads_used < $this->plan->monthly_download_limit;
        }
        
        return $this->downloads_used < $this->plan->getDownloadLimit($this->billing_cycle);
    }

    public function downloads()
    {
        return $this->hasMany(Download::class);
    }

    public function paymentLogs()
    {
        return $this->hasMany(PaymentLog::class, 'stripe_subscription_id', 'stripe_subscription_id');
    }
    
}