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
        Schema::create('advertisements', function (Blueprint $table) {
    $table->string('ad_id', 20)->primary();
    // Correcting property_id to match your Property table PK type
    $table->string('property_id', 20); 
    // Correcting media_source to accept text
    $table->string('media_source', 50); 
    // Correcting date_advertised to actual date type
    $table->date('date_advertised'); 
    $table->decimal('cost', 10, 2);
    $table->timestamps();

    // Set up the foreign key constraint
    $table->foreign('property_id')->references('property_id')->on('properties');
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('advertisements');
    }
};
