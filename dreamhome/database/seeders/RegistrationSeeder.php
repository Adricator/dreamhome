<?php

namespace Database\Seeders;

use App\Models\Registration;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RegistrationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Registration::create([
            'client_id' => 'CL001',
            'staff_id' => 'ST001',
            'branch_id' => 'BR001',
            'date_joined' => '2020-01-15'
        ]);

        Registration::create([
            'client_id' => 'CL001',
            'staff_id' => 'ST002',
            'branch_id' => 'BR002',
            'date_joined' => '2021-06-10'
        ]);

        Registration::create([
            'client_id' => 'CL001',
            'staff_id' => 'ST003',
            'branch_id' => 'BR003',
            'date_joined' => '2022-02-20'
        ]);

        Registration::create([
            'client_id' => 'CL001',
            'staff_id' => 'ST004',
            'branch_id' => 'BR004',
            'date_joined' => '2019-08-01'
        ]);

    }
}
