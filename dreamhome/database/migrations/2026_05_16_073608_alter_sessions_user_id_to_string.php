<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function run(): void
    {
        Schema::table('sessions', function (Blueprint $table) {
            // Change user_id from BIGINT to VARCHAR/string to accept "ST0001"
            $table->string('user_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function runDown(): void
    {
        Schema::table('sessions', function (Blueprint $table) {
            // Revert back to original bigint if rolled back
            $table->foreignId('user_id')->nullable()->change();
        });
    }
};