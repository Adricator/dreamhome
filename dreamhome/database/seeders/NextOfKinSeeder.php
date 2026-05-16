<?php

namespace Database\Seeders;
use App\Models\NextOfKin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NextOfKinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        NextOfKin::create([
            'staff_id' => 'ST0001',
            'full_name' => 'John Doe',
            'relationship' => 'sister',
            'address' => '123 Main St, Anytown',
            'telephone_no' => '07123456789'
        ]);
        NextOfKin::create([
            'staff_id' => 'ST0002',
            'full_name' => 'Jane Smith',
            'relationship' => 'brother',
            'address' => '456 Elm St, Othertown',
            'telephone_no' => '07234567890'
        ]);
        NextOfKin::create([
            'staff_id' => 'ST0003',
            'full_name' => 'Emily Johnson',
            'relationship' => 'mother',
            'address' => '789 Oak St, Sometown',
            'telephone_no' => '07345678901'
        ]);
    }
}