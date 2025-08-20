<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class Subuser extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'parent_user_id', 'name', 'email', 'mobile', 'position', 'password', 'is_active'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get the parent user that owns the subuser.
     */
    public function parentUser()
    {
        return $this->belongsTo(User::class, 'parent_user_id');
    }
    public function getUserType()
    {
        return 'subuser';
    }

    public function isActive()
    {
        return $this->is_active;
    }

    // Inherit parent user's properties when needed
    public function getCompanyNameAttribute()
    {
        return $this->parentUser->company_name;
    }

    public function getCompanyAddressAttribute()
    {
        return $this->parentUser->company_address;
    }

    public function getStripeCustomerIdAttribute()
    {
        return $this->parentUser->stripe_customer_id;
    }
}
