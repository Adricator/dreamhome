<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
    Schema::create('owners', function (Blueprint $table) {
    $table->string('owner_id')->primary();
    $table->string('first_name');
    $table->string('last_name');
    $table->text('address');
    $table->string('telephone_no');
    $table->text('email')->nullable();

});


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('owners');
    }
};
