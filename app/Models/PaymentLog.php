<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentLog extends Model
{
    protected $table = 'payment_logs';
    protected $fillable = [
        'user_id',
        'plan_id',
        'session_id',
        'amount',
        'status', // pending, success, cancelled
        'payment_method', // stripe etc.
        'card_last_4',
        'card_brand',
        'stripe_subscription_id',
        'transaction_type', // one-time, subscription
    ];
    protected $casts = [
        'amount' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function subscription()
    {
        return $this->belongsTo(Subscription::class, 'stripe_subscription_id', 'stripe_subscription_id');
    }
    
}
