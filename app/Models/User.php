<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\Plan;
use App\Models\Subuser;
use App\Models\Creative;
use App\Models\PaymentLog;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use App\Notifications\VerifyEmailNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'role',
        'name',
        'company_name',
        'company_address',
        'mobile',
        'email',
        'password',
    ];
 
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function getUserType()
    {
        return 'user';
    }

    public function isAdmin() {
        return $this->role == 1;
    }

    public function isSuperAdmin() {
        return $this->role == 2;
    }

    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmailNotification());
    }

    /**
     * Get role name
     */
    public function getRoleName(): string
    {
        return match($this->role) {
            0 => 'User',
            1 => 'Admin',
            2 => 'Super Admin',
            default => 'Unknown'
        };
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    protected function type(): Attribute
    {
        return new Attribute(
            get: fn ($value) =>  ["user", "admin", "superadmin"][$value],
        );
    }

    /**
     * Get the subusers associated with this user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subusers()
    {
        return $this->hasMany(Subuser::class, 'parent_user_id');
    }

    public function creatives()
    {
        return $this->hasMany(Creative::class);
    }
    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function downloads()
    {
        return $this->hasMany(Download::class);
    }

    public function paymentLogs()
    {
        return $this->hasMany(PaymentLog::class);
    }

    public function activeSubscription()
    {
        return $this->subscriptions()
            ->where('status', 'active')
            ->where('expires_at', '>', now())
            ->latest();
    }

    public function currentPlan()
    {
        $subscription = $this->activeSubscription();
        
        if (!$subscription) {
            // Return free plan if no active subscription
            return Plan::where('slug', 'free')->first();
        }
        
        return $subscription->plan;
    }

    public function canDownload()
    {
        $subscription = $this->activeSubscription();
        
        if (!$subscription) {
            // Check if free plan allows downloads
            $freePlan = Plan::where('slug', 'free')->first();
            
            if (!$freePlan) {
                return false;
            }
            
            // Get count of free downloads
            $freeDownloadsCount = $this->downloads()
                ->whereDate('created_at', '>=', now()->startOfMonth())
                ->count();
                
            return $freePlan->monthly_download_limit === 0 || $freeDownloadsCount < $freePlan->monthly_download_limit;
        }
        
        return $subscription->hasDownloadsLeft();
    }

    public function hasActiveSubscription()
    {
        return $this->activeSubscription()->exists();
    }

    public function isSubscribedToPlan($planId)
    {
        return $this->activeSubscription()
                    ->where('plan_id', $planId)
                    ->exists();
    }
    
}
