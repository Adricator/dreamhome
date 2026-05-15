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
        Schema::create('branches', function (Blueprint $table) {
        $table->string('branch_id')->primary();
        $table->text('street');
        $table->text('area');
        $table->text('city');
        $table->text('postcode');
        $table->string('telephone_no');
        $table->string('fax_no')->nullable();
        $table->string('manager_id')->nullable(); //references staff_id(staff_id)
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branches');
    }
};
