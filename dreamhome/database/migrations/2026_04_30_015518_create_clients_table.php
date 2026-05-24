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
        Schema::create('clients', function (Blueprint $table) {
            $table->string('client_id')->primary();
            $table->string('first_name');
            $table->string('last_name');
            $table->text('address');
            $table->string('telephone_no');
            $table->text('email')->nullable();
            $table->string('prefer_type')->nullable();
            $table->decimal('max_rent',10,2)->nullable();
            $table->string('password');
            $table->rememberToken();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
