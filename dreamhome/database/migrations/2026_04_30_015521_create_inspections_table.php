<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('inspections', function (Blueprint $table) {
            $table->uuid('inspection_id')->primary(); // Replaces id() or bigIncrements() // ... rest of your columns
            $table->string('property_id', 20);      // varchar(20) Foreign Key
            $table->date('inspection_date');        // date
            $table->string('staff_id', 20);         // varchar(20) Foreign Key
            $table->text('comments')->nullable();   // text
            $table->timestamps();

            // Set up Foreign key restrictions if your tables exist:
            // $table->foreign('property_id')->references('property_id')->on('properties')->onDelete('cascade');
            // $table->foreign('staff_id')->references('staff_id')->on('staff')->onDelete('cascade');

            // This prevents the exact same property from having multiple inspections on the same day
            $table->unique(['property_id', 'inspection_date']);

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inspections');
    }
};