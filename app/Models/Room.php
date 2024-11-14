<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    // Fillable attributes
    protected $fillable = [
        'title',
        'quantity',
        'description',
        'price',
        'photos',
        'amenities',
        'refId',
        'room_numbers',
        'maxGuest'

    ];

    // Optionally, if you're using the JSON columns for amenities and photos,
    // you may want to cast them to arrays for easier manipulation
    protected $casts = [
        'amenities' => 'array',
        'photos' => 'array', // Add this line to cast photos to an array
        'room_numbers' => 'array', // Add this line to cast room_numbers to an array
    ];
    
}
