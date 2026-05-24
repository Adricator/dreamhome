<?php

namespace Database\Seeders;
use App\Models\Inspection;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InspectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Inspection::create([
            'inspection_id' => 1,
            'property_id' => 'PR001',
            'staff_id' => 'ST0001',
            'inspection_date' => '2024-05-01',
            'comments' => 'No comments provided '
        ]);

        Inspection::create([
            'inspection_id' => 2,
            'property_id' => 'PR002',
            'staff_id' => 'ST0002',
            'inspection_date' => '2024-05-02',
            'comments' => 'Minor wear on kitchen counters. Scratches near the main basin area require polishing. Cabinet doors alignment checked.'
        ]);

        Inspection::create([
            'inspection_id' => 3,
            'property_id' => 'PR003',
            'staff_id' => 'ST0003',
            'inspection_date' => '2024-05-03',
            'comments' => 'No comments provided '
        ]);

        Inspection::create([
            'inspection_id' => 4,
            'property_id' => 'PR004',
            'staff_id' => 'ST0004',
            'inspection_date' => '2024-05-04',
            'comments' => 'HVAC filter needs immediate replacement. Master bathroom exhaust fan making grinding noise. Recommendations left with tenant.'
        ]);
    }
}
