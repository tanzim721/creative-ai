<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PromoCode extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'type',
        'value',	
        'start_time',
        'end_time',
        'usage_limit',
        'used_count',
        'is_active',
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'is_active' => 'boolean',
    ];

    /**
     * Check if the promo code is currently valid
     */
    public function isValid(): bool
    {
        $now = Carbon::now();
        return $this->is_active && $now->between($this->start_time, $this->end_time);
    }

    /**
     * Scope a query to get only active promo codes
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope a query to get current valid promo codes (active and within time frame)
     */
    public function scopeValid($query)
    {
        $now = Carbon::now();
        return $query->where('is_active', true)
                    ->where('start_time', '<=', $now)
                    ->where('end_time', '>=', $now);
    }

    /**
     * Get the currently active promo code
     */
    public static function getActiveCode()
    {
        try {
            // First try to get a valid code (active AND within timeframe)
            $activeCode = self::valid()->first()?->code;
            
            // If no valid code found, fall back to any active code
            if (!$activeCode) {
                $activeCode = self::active()->first()?->code;
            }
            
            return $activeCode;
        } catch (\Exception $e) {
            report($e);
            return null;
        }
    }
    
    /**
     * Get the currently active promo code or default
     * 
     * @param string $default
     * @return string
     */
    public static function getActiveCodeOrDefault($default = null)
    {
        $code = self::getActiveCode();
        return $code ?: ($default ?: config('auth.defaults.admin_code'));
    }
    
    public function calculateDiscount($originalPrice)
    {
        if ($this->type === 'free') {
            return $originalPrice; // Full discount
        } else if ($this->type === 'percentage') {
            return ($originalPrice * $this->value) / 100;
        } else { // fixed discount
            return min($this->value, $originalPrice); // Cannot discount more than the original price
        }
    }
}
