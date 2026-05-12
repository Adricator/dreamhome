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
            'inspection_id' => 'INS001',
            'property_id' => 'PROP001',
            'staff_id' => 'ST001',
            'date' => '2024-05-01',
            'comment' => 'passed'
        ]);

        Inspection::create([
            'inspection_id' => 'INS002',
            'property_id' => 'PROP002',
            'staff_id' => 'ST002',
            'date' => '2024-05-02',
            'comment' => 'failed'
        ]);

        Inspection::create([
            'inspection_id' => 'INS003',
            'property_id' => 'PROP003',
            'staff_id' => 'ST003',
            'date' => '2024-05-03',
            'comment' => 'passed'
        ]);

        Inspection::create([
            'inspection_id' => 'INS004',
            'property_id' => 'PROP004',
            'staff_id' => 'ST004',
            'date' => '2024-05-04',
            'comment' => 'failed'
        ]);

        Inspection::create([
            'inspection_id' => 'INS005',
            'property_id' => 'PROP005',
            'staff_id' => 'ST005',
            'date' => '2024-05-05',
            'comment' => 'passed'
        ]);
    }
}
