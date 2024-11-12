<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'name',
        'logo',
        'favicon',
        'hero_background',
        'hero_header',
        'hero_subheader',
        'button1_text',
        'button1_link',
        'button2_text',
        'button2_link',
        'highlights', // JSON field for storing highlights
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'highlights' => 'array', // Casts highlights as an array for easy access
    ];
}
