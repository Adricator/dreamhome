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
        Schema::create('inspections', function (Blueprint $table) {
            $table->integer('inspection_no'); 
            $table->string('property_id');
            
            $table->string('staff_id');
            $table->date('date');
            $table->text('comment');

            // 1. Define the Composite Primary Key
            $table->primary(['inspection_no', 'property_id']);

            // 2. Define Foreign Key for property_id
            $table->foreign('property_id')
                ->references('property_id')
                ->on('properties')
                ->onDelete('cascade');

            // 3. Define Foreign Key for staff_id
            $table->foreign('staff_id')
                ->references('staff_id')
                ->on('staff')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inspections');
    }
};
