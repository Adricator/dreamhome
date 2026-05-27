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
        Schema::create('viewings', function (Blueprint $table) {
            $table->string('viewing_id', 20)->primary();

            $table->string('client_id', 20);
            $table->string('property_id', 20);

            // Staff/web side will set this later
            $table->dateTime('view_date')->nullable();
            $table->string('staff_id', 20)->nullable();

            $table->text('comments')->nullable();
            $table->string('status', 20)->default('pending');

            $table->foreign('client_id')
                ->references('client_id')
                ->on('clients')
                ->onDelete('cascade');

            $table->foreign('property_id')
                ->references('property_id')
                ->on('properties')
                ->onDelete('cascade');

            $table->foreign('staff_id')
                ->references('staff_id')
                ->on('staff')
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('viewings');
    }
};