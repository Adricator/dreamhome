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
Schema::create('properties', function (Blueprint $table) {
    $table->string('property_id')->primary();

    // Change foreignId to string to match the 'private_owners' table
    $table->string('owner_id');
    $table->foreign('owner_id')->references('owner_id')->on('private_owners')->onDelete('cascade');

    // Do the same for branch_id and staff_id if they are also strings in their respective tables
    $table->string('branch_id');
    $table->foreign('branch_id')->references('branch_id')->on('branches')->onDelete('cascade');

    $table->string('staff_id')->nullable();
    $table->foreign('staff_id')->references('staff_id')->on('staff')->onDelete('set null');

    $table->string('street');
    $table->string('area');
    $table->string('city');
    $table->string('postcode');

    $table->string('type');
    $table->integer('rooms');
    $table->decimal('monthly_rent', 10, 2);

    $table->enum('status', ['available', 'maintenance', 'rented', 'reserved']);

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
