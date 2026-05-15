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
        Schema::create('leases', function (Blueprint $table) {
            $table->string('lease_id')->primary();

            $table->string('property_id');
            $table->string('client_id');
            $table->string('staff_id');

            $table->string('payment_method'); // Changed from date to string
            $table->decimal('deposit', 10, 2);
            $table->boolean('deposit_paid')->default(false);

            $table->date('start_date');
            $table->date('end_date');
            $table->integer('duration_months');

            // Foreign Key Constraints
            $table->foreign('property_id')
                ->references('property_id')
                ->on('properties')
                ->onDelete('cascade');

            $table->foreign('client_id')
                ->references('client_id')
                ->on('clients')
                ->onDelete('cascade');

            $table->foreign('staff_id')
                ->references('staff_id')
                ->on('staff')
                ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leases');
    }
};
