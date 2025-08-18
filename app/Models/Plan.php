<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Plan extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'slug',
        'stripe_price_id',
        'description',
        'monthly_price',
        'yearly_price',
        'monthly_download_limit',
        'yearly_download_limit',
        'features',
        'is_custom',
        'is_active',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'monthly_price' => 'decimal:2',
        'yearly_price' => 'decimal:2',
        'monthly_download_limit' => 'integer',
        'yearly_download_limit' => 'integer',
        'features' => 'array',
        'is_custom' => 'boolean',
        'is_active' => 'boolean',
    ];

    /**
     * Get formatted monthly price.
     */
    public function getFormattedMonthlyPriceAttribute()
    {
        return '$' . number_format($this->monthly_price, 2);
    }

    /**
     * Get formatted yearly price.
     */
    public function getFormattedYearlyPriceAttribute()
    {
        return '$' . number_format($this->yearly_price, 2);
    }

    /**
     * Calculate monthly savings compared to buying monthly plan.
     */
    public function getMonthlySavingsAttribute()
    {
        if ($this->monthly_price <= 0) {
            return 0;
        }

        $yearlyMonthlyEquivalent = $this->yearly_price / 12;
        $savings = $this->monthly_price - $yearlyMonthlyEquivalent;

        return max(0, $savings);
    }

    /**
     * Calculate percentage savings for yearly plan.
     */
    public function getYearlySavingsPercentageAttribute()
    {
        if ($this->monthly_price <= 0) {
            return 0;
        }

        $yearlyMonthlyEquivalent = $this->yearly_price / 12;
        $savings = $this->monthly_price - $yearlyMonthlyEquivalent;
        $percentage = ($savings / $this->monthly_price) * 100;

        return round(max(0, $percentage));
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function paymentLogs()
    {
        return $this->hasMany(PaymentLog::class);
    }
}
