<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str; // Required to generate valid UUID strings

class InspectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('inspections')->insert([
            [
                'inspection_id'   => (string) Str::uuid(), // Generates string formatted UUID
                'property_id'     => 'PR001',
                'staff_id'        => 'ST0001',
                'inspection_date' => '2024-05-01',
                'comments'        => 'No comments provided',
            ],
            [
                'inspection_id'   => (string) Str::uuid(),
                'property_id'     => 'PR002',
                'staff_id'        => 'ST0002',
                'inspection_date' => '2024-05-02',
                'comments'        => 'Minor wear on kitchen counters. Scratches near the main basin area require polishing. Cabinet doors alignment checked.',
            ],
            [
                'inspection_id'   => (string) Str::uuid(),
                'property_id'     => 'PR003',
                'staff_id'        => 'ST0003',
                'inspection_date' => '2024-05-03',
                'comments'        => 'No comments provided',
            ],
            [
                'inspection_id'   => (string) Str::uuid(),
                'property_id'     => 'PR004',
                'staff_id'        => 'ST0004',
                'inspection_date' => '2024-05-04',
                'comments'        => 'HVAC filter needs immediate replacement. Master bathroom exhaust fan making grinding noise. Recommendations left with tenant.',
            ],
        ]);
    }
}