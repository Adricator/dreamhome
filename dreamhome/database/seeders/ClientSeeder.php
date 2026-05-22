<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Client::create([
            'client_id' => 'CL001',
            'first_name' => 'Emily',
            'last_name' => 'Davis',
            'address' => '34 High Street, London',
            'telephone_no' => '+447911987654',
            'email' => 'emily.davis@example.com',
            'prefer_type' => 'apartment',
            'max_rent' => 1200.00,
            'password' => 'dreamhome123'
        ]);

        Client::create([
            'client_id' => 'CL002',
            'first_name' => 'James',
            'last_name' => 'Miller',
            'address' => '56 Market Street, Manchester',
            'telephone_no' => '+447922876543',
            'email' => 'james.miller@example.com',
            'prefer_type' => 'house',
            'max_rent' => 1500.00,
            'password' => 'dreamhome123'
        ]);

        Client::create([
            'client_id' => 'CL003',
            'first_name' => 'Olivia',
            'last_name' => 'Wilson',
            'address' => '78 Princes Street, Edinburgh',
            'telephone_no' => '+447933765432',
            'email' => 'olivia.wilson@example.com',
            'prefer_type' => 'apartment',
            'max_rent' => 1000.00,
            'password' => 'dreamhome123'
        ]);
        
        Client::create([
            'client_id' => 'CL004',
            'first_name' => 'Liam',
            'last_name' => 'Johnson',
            'address' => '12 Broad Street, Birmingham',
            'telephone_no' => '+447944654321',
            'email' => 'liam.johnson@example.com',
            'prefer_type' => 'house',
            'max_rent' => 1800.00,
            'password' => 'dreamhome123'
        ]);

        Client::create([
            'client_id' => 'CL005',
            'first_name' => 'Sophia',
            'last_name' => 'Brown',
            'address' => '90 Park Lane, Leeds',
            'telephone_no' => '+447955543210',
            'email' => 'sophia.brown@example.com',
            'prefer_type' => 'apartment',
            'max_rent' => 1100.00,
            'password' => 'dreamhome123'
        ]);
    }
}
