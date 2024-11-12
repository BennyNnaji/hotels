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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Room title
            $table->string('refId'); // Room title
            $table->unsignedTinyInteger('quantity'); // How many of such room
            $table->text('description'); // Room description
            $table->decimal('price', 10, 2); // Room price
            $table->json('photos'); // JSON to store photo paths
            $table->json('amenities')->nullable(); // JSON to store amenities
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
