<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Creative extends Model
{
    use HasFactory;

    protected $fillable = [
        'creative_type_id',
        'image',
        'video',
        'content',
        'cta_name',
        'cta_url',
        'creative_name',
        'user_id',
    ];

    public function creative_type()
    {
        return $this->belongsTo(CreativeType::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function game_type() 
    {
        return $this->belongsTo(GameType::class);
    }

    public function downloads()
    {
        return $this->hasMany(Download::class);
    }


}
