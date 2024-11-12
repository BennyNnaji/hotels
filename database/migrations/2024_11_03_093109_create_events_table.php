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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');                   // Title of the event
            $table->text('description');    // Description of the event
            $table->dateTime('date');                  // Date and time of the event
            $table->string('location');     // Location of the event
            $table->text('picture');      // Path to the event picture
            $table->decimal('ticket', 8, 2)->default(0); // Ticket price for the event
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
