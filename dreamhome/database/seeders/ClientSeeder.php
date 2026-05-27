<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('clients')->insert([

            [
                'client_id' => 'CL001',
                'branch_id' => 'BR001',
                'first_name' => 'Emily',
                'last_name' => 'Davis',
                'address' => '34 High Street, London',
                'telephone_no' => '+447911987654',
                'email' => 'emily.davis@example.com',
                'prefer_type' => 'apartment',
                'max_rent' => 1200.00,
                'password' => Hash::make('dreamhome123!'),
            ],
            [
                'client_id' => 'CL002',
                'branch_id' => 'BR002',
                'first_name' => 'James',
                'last_name' => 'Miller',
                'address' => '56 Market Street, Manchester',
                'telephone_no' => '+447922876543',
                'email' => 'james.miller@example.com',
                'prefer_type' => 'house',
                'max_rent' => 1500.00,
                'password' => Hash::make('dreamhome123!'),
            ],
            [
                'client_id' => 'CL003',
                'branch_id' => 'BR003',
                'first_name' => 'Olivia',
                'last_name' => 'Wilson',
                'address' => '78 Princes Street, Edinburgh',
                'telephone_no' => '+447933765432',
                'email' => 'olivia.wilson@example.com',
                'prefer_type' => 'apartment',
                'max_rent' => 1000.00,
                'password' => Hash::make('dreamhome123!'),
            ],
            [
                'client_id' => 'CL004',
                'branch_id' => 'BR003',
                'first_name' => 'Liam',
                'last_name' => 'Johnson',
                'address' => '12 Broad Street, Birmingham',
                'telephone_no' => '+447944654321',
                'email' => 'liam.johnson@example.com',
                'prefer_type' => 'house',
                'max_rent' => 1800.00,
                'password' => Hash::make('dreamhome123!'),
            ],
            [
                'client_id' => 'CL005',
                'branch_id' => null,
                'first_name' => 'Sophia',
                'last_name' => 'Brown',
                'address' => '90 Park Lane, Leeds',
                'telephone_no' => '+447955543210',
                'email' => 'sophia.brown@example.com',
                'prefer_type' => 'apartment',
                'max_rent' => 1100.00,
                'password' => Hash::make('dreamhome123!'),
            ],

            [
                'client_id' => 'CL006',
                'branch_id' => null,
                'first_name' => 'Noah',
                'last_name' => 'Smith',
                'address' => '102 George Street, Glasgow',
                'telephone_no' => '+447966432109',
                'email' => 'noah.smith@example.com',
                'prefer_type' => 'house',
                'max_rent' => 1650.00,
                'password' => Hash::make('dreamhome123!'),
            ],
            [
                'client_id' => 'CL007',
                'branch_id' => null,
                'first_name' => 'Ava',
                'last_name' => 'Jones',
                'address' => '15 Queen Square, Bristol',
                'telephone_no' => '+447977321098',
                'email' => 'ava.jones@example.com',
                'prefer_type' => 'apartment',
                'max_rent' => 1350.00,
                'password' => Hash::make('dreamhome123!!'),
            ],
        ]);
    }
}
