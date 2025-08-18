<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreativeType extends Model
{
    /** @use HasFactory<\Database\Factories\CreativeTypeFactory> */
    use HasFactory;

    protected $table = 'creative_types';

    protected $fillable = [
        'name',
    ];

    public function creatives()
    {
        return $this->hasMany(Creative::class);
    }

}
