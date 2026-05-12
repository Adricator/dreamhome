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
      Schema::create('staff', function (Blueprint $table) {
    $table->string('staff_id')->primary();
    $table->string('first_name');
    $table->string('last_name');
    $table->text('address');
    $table->string('telephone_no');
    $table->enum('sex', ['male','female']);
    $table->date('dob');
    $table->string('nin');
    $table->string('position');
    $table->decimal('salary',10,2);
    $table->date('date_joined');
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
