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
        Schema::create('payments', function (Blueprint $table) {
            // Use integer instead of serial to allow it to be part of a composite key
            $table->integer('payment_no');
            $table->string('lease_id');
            
            $table->decimal('amount', 10, 2);
            $table->date('payment_date');
            $table->string('payment_method');

            // Define the composite primary key
            $table->primary(['payment_no', 'lease_id']);

            // Set the foreign key reference to the leases table
            $table->foreign('lease_id')->references('lease_id')->on('leases')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
