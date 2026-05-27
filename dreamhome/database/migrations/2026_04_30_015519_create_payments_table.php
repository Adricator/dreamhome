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
            
            $table->integer('payment_no');
            $table->string('lease_id');
            
            $table->decimal('amount', 10, 2);
            $table->date('payment_date');
            $table->string('payment_method');

            
            $table->primary(['payment_no', 'lease_id']);

           
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
