<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    // Define the fillable attributes
    protected $fillable = [
        'fullName',   // Matches 'fullName' from the form
        'email',      // Matches 'email' from the form
        'phone',      // Matches 'phone' from the form
        'checkIn',    // Matches 'checkIn' from the form
        'checkOut',   // Matches 'checkOut' from the form
        'roomType',   // Matches 'roomType' from the form
        'guests',     // Matches 'guests' from the form
        'terms',      // Matches 'terms' from the form
        'marketing',   // Matches 'marketing' from the form
        'status',
        'payment',
        'ref',
        'price',
    ];
}
