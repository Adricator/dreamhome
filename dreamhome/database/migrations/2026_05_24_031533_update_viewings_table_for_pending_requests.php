<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    public function up(): void
    {
        // Remove old primary key: client_id + property_id + view_date
        DB::statement('ALTER TABLE viewings DROP CONSTRAINT IF EXISTS viewings_pkey');

        // Add new numeric id primary key
        if (!Schema::hasColumn('viewings', 'id')) {
            Schema::table('viewings', function (Blueprint $table) {
                $table->id()->first();
            });
        }

        // Allow admin to assign these later
        DB::statement('ALTER TABLE viewings ALTER COLUMN view_date DROP NOT NULL');
        DB::statement('ALTER TABLE viewings ALTER COLUMN staff_id DROP NOT NULL');

        // Add request status
        if (!Schema::hasColumn('viewings', 'status')) {
            Schema::table('viewings', function (Blueprint $table) {
                $table->string('status')->default('Pending');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('viewings', 'status')) {
            Schema::table('viewings', function (Blueprint $table) {
                $table->dropColumn('status');
            });
        }

        if (Schema::hasColumn('viewings', 'id')) {
            Schema::table('viewings', function (Blueprint $table) {
                $table->dropColumn('id');
            });
        }

        DB::statement('ALTER TABLE viewings ALTER COLUMN view_date SET NOT NULL');
        DB::statement('ALTER TABLE viewings ALTER COLUMN staff_id SET NOT NULL');

        DB::statement('ALTER TABLE viewings ADD PRIMARY KEY (client_id, property_id, view_date)');
    }
};