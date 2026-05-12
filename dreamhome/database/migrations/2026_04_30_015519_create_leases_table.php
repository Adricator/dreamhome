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

    $table->date('payment_method');
    $table->decimal('deposit', 10, 2);
    $table->boolean('deposit_paid');

    $table->date('start_date');
    $table->date('end_date');

    $table->integer('duration_months');

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
