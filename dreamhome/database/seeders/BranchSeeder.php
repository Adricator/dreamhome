<?php

namespace Database\Seeders;

use App\Models\Branch;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('branches')->insert([
            [
                'branch_id' => 'BR001',
                'street' => '143 Main Street',
                'area' => 'City Center',
                'city' => 'London',
                'postcode' => '6070',
                'telephone_no' => '0207-111-2222',
                'fax_no' => '0207-111-3333',
                'manager_id' => null,
            ],
            [
                'branch_id' => 'BR002',
                'street' => '55 George Street',
                'area' => 'West End',
                'city' => 'Glasgow',
                'postcode' => '7860',
                'telephone_no' => '0141-444-5555',
                'fax_no' => '0141-444-6664',
                'manager_id' => null,
            ],
            [
                'branch_id' => 'BR003',
                'street' => '101 Dalton Road',
                'area' => 'Southside',
                'city' => 'Manchester',
                'postcode' => '2769',
                'telephone_no' => '0161-777-8888',
                'fax_no' => '0161-777-9999',
                'manager_id' => null,
            ],
        ]);
    }
}
