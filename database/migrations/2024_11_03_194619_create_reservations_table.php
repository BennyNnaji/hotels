<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            // Personal Information
            $table->string('fullName'); // Matches 'fullName' attribute in form
            $table->string('email');    // Matches 'email' attribute in form
            $table->string('phone')->nullable(); // Matches 'phone' attribute in form

            // Booking Details
            $table->date('checkIn');    // Matches 'checkIn' attribute in form
            $table->date('checkOut');   // Matches 'checkOut' attribute in form
            $table->string('roomType');  // Matches 'roomType' attribute in form
            $table->integer('guests')->unsigned(); // Matches 'guests' attribute in form
            $table->decimal('price', 10, 2); //  price
            $table->string('ref'); 

            // Agreement and Consent
            $table->boolean('terms')->default(false);    // Matches 'terms' attribute in form
            $table->boolean('marketing')->default(false); // Matches 'marketing' attribute in form
            $table->boolean('payment')->default(false); 
            $table->string('status')->default('active');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
