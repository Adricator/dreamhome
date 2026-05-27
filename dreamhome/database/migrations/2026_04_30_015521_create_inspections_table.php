<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('inspections', function (Blueprint $table) {
        // 1. Primary Key using UUID
        $table->uuid('inspection_id')->primary();
        
        // 2. Data Columns (matching string types from your previous modules)
        $table->string('property_id');
        $table->string('staff_id');
        $table->date('inspection_date');
        $table->text('comments')->nullable();
        $table->timestamps();

        // 3. Foreign Key Constraints
        // Links inspection data to specific parent properties and staff accounts
        $table->foreign('property_id')
            ->references('property_id')
            ->on('properties')
            ->onDelete('cascade');

        $table->foreign('staff_id')
            ->references('staff_id')
            ->on('staff')
            ->onDelete('cascade');

        // 4. Case Study Business Rule
        // Prevents an inspector from logging two conflicting entries for a single property on the exact same calendar date
        $table->unique(['property_id', 'inspection_date']);
    });
    }

    public function down(): void
    {
        Schema::dropIfExists('inspections');
    }
};