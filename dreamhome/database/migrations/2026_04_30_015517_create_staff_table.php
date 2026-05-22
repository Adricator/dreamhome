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
        // 1. Create the table structure first
        Schema::create('staff', function (Blueprint $table) {
            $table->string('staff_id')->primary(); // Ensure this is definitely here
            $table->string('first_name');
            $table->string('last_name');
            $table->string('branch_id'); 
            $table->string('supervised_by')->nullable();
            $table->text('address');
            $table->string('telephone_no')->unique();
            $table->string('email')->unique();
            $table->enum('sex', ['male', 'female']);
            $table->date('dob');
            $table->string('nin')->unique();
            $table->string('position');
            $table->decimal('salary', 10, 2);
            $table->date('date_hired');
            $table->decimal('car_allowance', 10, 2)->nullable();
            $table->decimal('performance_bonus', 10, 2)->nullable();
            $table->date('date_promoted')->nullable();
            $table->integer('typing_speed_wpm')->nullable();
            $table->string('password');
            $table->rememberToken();
        });

        // 2. Now add the foreign keys in a separate block
        Schema::table('staff', function (Blueprint $table) {
            $table->foreign('branch_id')->references('branch_id')->on('branches');
            $table->foreign('supervised_by')->references('staff_id')->on('staff');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff');
    }
};
