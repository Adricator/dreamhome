<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('inspections', function (Blueprint $table) {
        
        $table->uuid('inspection_id')->primary();
        
        
        $table->string('property_id');
        $table->string('staff_id');
        $table->date('inspection_date');
        $table->text('comments')->nullable();
        $table->timestamps();

       
        $table->foreign('property_id')
            ->references('property_id')
            ->on('properties')
            ->onDelete('cascade');

        $table->foreign('staff_id')
            ->references('staff_id')
            ->on('staff')
            ->onDelete('cascade');

        
        $table->unique(['property_id', 'inspection_date']);
    });
    }

    public function down(): void
    {
        Schema::dropIfExists('inspections');
    }
};