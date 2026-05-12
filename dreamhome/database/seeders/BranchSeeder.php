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
        Branch::create([
            'branch_id' => 'BR001',
            'street' => 'Baker Street',
            'area' => 'Marylebone',
            'city' => 'London',
            'postcode' => 'NW1 6XE',
            'telephone_no' => '02079460001',
            'fax_no' => '02079460002'
        ]);

        Branch::create([
            'branch_id' => 'BR002',
            'street' => 'Deansgate',
            'area' => 'City Centre',
            'city' => 'Manchester',
            'postcode' => 'M3 2BW',
            'telephone_no' => '01618300001',
            'fax_no' => '01618300002'
        ]);

        Branch::create([
            'branch_id' => 'BR003',
            'street' => 'Princes Street',
            'area' => 'Old Town',
            'city' => 'Edinburgh',
            'postcode' => 'EH2 2ER',
            'telephone_no' => '01315500001',
            'fax_no' => '01315500002'
        ]);

        Branch::create([
            'branch_id' => 'BR004',
            'street' => 'Broad Street',
            'area' => 'Central',
            'city' => 'Birmingham',
            'postcode' => 'B1 2HF',
            'telephone_no' => '01216300001',
            'fax_no' => '01216300002'
        ]);

        Branch::create([
            'branch_id' => 'BR005',
            'street' => 'Park Row',
            'area' => 'City Centre',
            'city' => 'Leeds',
            'postcode' => 'LS1 5AB',
            'telephone_no' => '01132400001',
            'fax_no' => '01132400002'
        ]);
    }
}
