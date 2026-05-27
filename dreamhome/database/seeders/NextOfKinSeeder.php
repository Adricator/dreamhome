<?php

namespace Database\Seeders;
use App\Models\NextOfKin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NextOfKinSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('next_of_kin')->insert([
            [
                'staff_id' => 'ST0001', 
                'full_name' => 'Elena Diaz', 
                'relationship' => 'Spouse', 
                'address' => '12 High St, London', 
                'telephone_no' => '0770-011-9901'
            ],
            [
                'staff_id' => 'ST0002', 
                'full_name' => 'Robert Alforque', 
                'relationship' => 'Parent', 
                'address' => '45 Baker St, Glasgow', 
                'telephone_no' => '0770-022-9902'
            ],
            [
                'staff_id' => 'ST0003', 
                'full_name' => 'Miriam Layong', 
                'relationship' => 'Spouse', 
                'address' => '88 Deansgate, Manchester', 
                'telephone_no' => '0770-033-9903'
            ],

            
            [
                'staff_id' => 'ST0004', 
                'full_name' => 'Mark Jenkins', 
                'relationship' => 'Spouse', 
                'address' => '12 Abbey Rd, London', 
                'telephone_no' => '0770-011-9904'
            ],
            [
                'staff_id' => 'ST0005', 
                'full_name' => 'Chinedu Okonkwo', 
                'relationship' => 'Sibling', 
                'address' => '45 Baker St, London', 
                'telephone_no' => '0770-011-9905'
            ],

            
            [
                'staff_id' => 'ST0006', 
                'full_name' => 'Callum McLeod', 
                'relationship' => 'Spouse', 
                'address' => '10 Sauchiehall St, Glasgow', 
                'telephone_no' => '0770-011-9906'
            ],
            [
                'staff_id' => 'ST0007', 
                'full_name' => 'Linda Wright', 
                'relationship' => 'Parent', 
                'address' => '31 Buchanan St, Glasgow', 
                'telephone_no' => '0770-011-9907'
            ],

            
            [
                'staff_id' => 'ST0008', 
                'full_name' => 'Min-Jun Kim', 
                'relationship' => 'Parent', 
                'address' => '15 Deansgate, Manchester', 
                'telephone_no' => '0770-011-9908'
            ],
            [
                'staff_id' => 'ST0009', 
                'full_name' => 'Peggy Gallagher', 
                'relationship' => 'Parent', 
                'address' => '20 Wilmslow Rd, Manchester', 
                'telephone_no' => '0770-011-9909'
            ],

            
            [
                'staff_id' => 'ST0010', 
                'full_name' => 'Thomas Smyth', 
                'relationship' => 'Sibling', 
                'address' => 'London Flat 1', 
                'telephone_no' => '0770-022-9910'
            ],
            [
                'staff_id' => 'ST0011', 
                'full_name' => 'Sarah Miller', 
                'relationship' => 'Spouse', 
                'address' => 'London Flat 2', 
                'telephone_no' => '0770-022-9911'
            ],
            [
                'staff_id' => 'ST0012', 
                'full_name' => 'Kevin Tan', 
                'relationship' => 'Sibling', 
                'address' => 'Glasgow Flat 1', 
                'telephone_no' => '0770-022-9912'
            ],
            [
                'staff_id' => 'ST0013', 
                'full_name' => 'Mei Lee', 
                'relationship' => 'Parent', 
                'address' => 'Glasgow Flat 2', 
                'telephone_no' => '0770-022-9913'
            ],
            [
                'staff_id' => 'ST0014', 
                'full_name' => 'Arthur White', 
                'relationship' => 'Parent', 
                'address' => 'Manchester Flat 1', 
                'telephone_no' => '0770-022-9914'
            ],
            [
                'staff_id' => 'ST0015', 
                'full_name' => 'Beatrice Black', 
                'relationship' => 'Spouse', 
                'address' => 'Manchester Flat 2', 
                'telephone_no' => '0770-022-9915'
            ],

            
            [
                'staff_id' => 'ST0016', 
                'full_name' => 'Richard Doe', 
                'relationship' => 'Parent', 
                'address' => 'Street 1, London', 
                'telephone_no' => '0770-033-9916'
            ],
            [
                'staff_id' => 'ST0017', 
                'full_name' => 'Margaret Doe', 
                'relationship' => 'Parent', 
                'address' => 'Street 2, London', 
                'telephone_no' => '0770-033-9917'
            ],
            [
                'staff_id' => 'ST0018', 
                'full_name' => 'Eleanor Smith', 
                'relationship' => 'Sibling', 
                'address' => 'Street 3, London', 
                'telephone_no' => '0770-033-9918'
            ],
            [
                'staff_id' => 'ST0019', 
                'full_name' => 'James Bee', 
                'relationship' => 'Spouse', 
                'address' => 'Street 4, London', 
                'telephone_no' => '0770-033-9919'
            ],
            [
                'staff_id' => 'ST0020', 
                'full_name' => 'William Cook', 
                'relationship' => 'Parent', 
                'address' => 'Street 5, London', 
                'telephone_no' => '0770-033-9920'
            ],
        ]);
    }
    
}