<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Owner;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class OwnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Owner::create([
            'owner_id' => 'OWN001',
            'first_name' => 'Oliver',
            'last_name' => 'Smith',
            'address' => '12 Baker Street, London',
            'telephone_no' => '+447911123456',
            'email' => 'oliver.smith@email.co.uk'
        ]);

        Owner::create([
            'owner_id' => 'OWN002',
            'first_name' => 'Amelia',
            'last_name' => 'Johnson',
            'address' => '45 Deansgate, Manchester',
            'telephone_no' => '+447922234567',
            'email' => 'amelia.johnson@email.co.uk'
        ]);

        Owner::create([
            'owner_id' => 'OWN003',
            'first_name' => 'George',
            'last_name' => 'Brown',
            'address' => '78 Princes Street, Edinburgh',
            'telephone_no' => '+447933345678',
            'email' => 'george.brown@email.co.uk'
        ]);

        Owner::create([
            'owner_id' => 'OWN004',
            'first_name' => 'Isla',
            'last_name' => 'Taylor',
            'address' => '22 Broad Street, Birmingham',
            'telephone_no' => '+447944456789',
            'email' => 'isla.taylor@email.co.uk'
        ]);

        Owner::create([
            'owner_id' => 'OWN005',
            'first_name' => 'Harry',
            'last_name' => 'Wilson',
            'address' => '10 Park Lane, Leeds',
            'telephone_no' => '+447955567890',
            'email' => 'harry.wilson@email.co.uk'
        ]);
    }
}
