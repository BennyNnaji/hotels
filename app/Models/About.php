<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    protected $fillable = [
        'about_us',
        'about_us_image',
        'mission',
        'vision',
        'amenities',
        'team',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'amenities' => 'array',
        'team' => 'array',
    ];
}
