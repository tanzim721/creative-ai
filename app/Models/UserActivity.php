<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserActivity extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'user_type',
        'activity_type',
        'activity_name',
        'url',
        'method',
        'metadata',
        'ip_address',
        'user_agent',
        'session_id',
    ];

    protected $casts = [
        'metadata' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relationships
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function subuser(): BelongsTo
    {
        return $this->belongsTo(Subuser::class, 'user_id');
    }

    // Scopes
    public function scopeForUser($query, $userId, $userType = 'user')
    {
        return $query->where('user_id', $userId)->where('user_type', $userType);
    }

    public function scopeByActivityType($query, $type)
    {
        return $query->where('activity_type', $type);
    }

    public function scopeToday($query)
    {
        return $query->whereDate('created_at', today());
    }

    public function scopeThisWeek($query)
    {
        return $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
    }

    public function scopeThisMonth($query)
    {
        return $query->whereMonth('created_at', now()->month);
    }

    // Accessors
    public function getFormattedCreatedAtAttribute()
    {
        return $this->created_at->format('M d, Y H:i:s');
    }

    public function getUserNameAttribute()
    {
        if ($this->user_type === 'subuser' && $this->subuser) {
            return $this->subuser->name;
        }
        
        return $this->user ? $this->user->name : 'Guest';
    }

    public function getBrowserAttribute()
    {
        if (!$this->user_agent) {
            return 'Unknown';
        }

        if (str_contains($this->user_agent, 'Chrome')) return 'Chrome';
        if (str_contains($this->user_agent, 'Firefox')) return 'Firefox';
        if (str_contains($this->user_agent, 'Safari')) return 'Safari';
        if (str_contains($this->user_agent, 'Edge')) return 'Edge';
        
        return 'Other';
    }
}