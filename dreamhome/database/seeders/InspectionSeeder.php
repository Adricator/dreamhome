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
            'inspection_no' => 1,
            'property_id' => 'PR001',
            'staff_id' => 'ST0001',
            'date' => '2024-05-01',
            'comment' => 'passed'
        ]);

        Inspection::create([
            'inspection_no' => 1,
            'property_id' => 'PR002',
            'staff_id' => 'ST0002',
            'date' => '2024-05-02',
            'comment' => 'failed'
        ]);

        Inspection::create([
            'inspection_no' => 1,
            'property_id' => 'PR003',
            'staff_id' => 'ST0003',
            'date' => '2024-05-03',
            'comment' => 'passed'
        ]);

        Inspection::create([
            'inspection_no' => 1,
            'property_id' => 'PR004',
            'staff_id' => 'ST0004',
            'date' => '2024-05-04',
            'comment' => 'failed'
        ]);
    }
}
