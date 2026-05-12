<?php

namespace Database\Seeders;
use App\Models\Staff;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Staff::create([
                'staff_id' => 'ST001',
                'first_name' => 'Emily',
                'last_name' => 'Clark',
                'address' => 'London',
                'telephone_no' => '+447700111111',
                'sex' => 'female',
                'dob' => '1990-03-12',
                'nin' => 'NIN001',
                'position' => 'manager',
                'salary' => 40000,
                'date_joined' => '2020-01-15'
            ]);
            Staff::create([
                'staff_id' => 'ST002',
                'first_name' => 'Jack',
                'last_name' => 'White',
                'address' => 'Manchester',
                'telephone_no' => '+447700222222',
                'sex' => 'male',
                'dob' => '1988-07-22',
                'nin' => 'NIN002',
                'position' => 'supervisor',
                'salary' => 32000,
                'date_joined' => '2021-06-10'
            ]);
            Staff::create([
                'staff_id' => 'ST003',
                'first_name' => 'Sophia',
                'last_name' => 'Green',
                'address' => 'Edinburgh',
                'telephone_no' => '+447700333333',
                'sex' => 'female',
                'dob' => '1995-11-05',
                'nin' => 'NIN003',
                'position' => 'assistant',
                'salary' => 28000,
                'date_joined' => '2022-02-20'
            ]);
            Staff::create([
                'staff_id' => 'ST004',
                'first_name' => 'Liam',
                'last_name' => 'Hall',
                'address' => 'Birmingham',
                'telephone_no' => '+447700444444',
                'sex' => 'male',
                'dob' => '1992-09-18',
                'nin' => 'NIN004',
                'position' => 'manager',
                'salary' => 41000,
                'date_joined' => '2019-08-01'
            ]);
            Staff::create([
                'staff_id' => 'ST005',
                'first_name' => 'Mia',
                'last_name' => 'Allen',
                'address' => 'Leeds',
                'telephone_no' => '+447700555555',
                'sex' => 'female',
                'dob' => '1998-01-30',
                'nin' => 'NIN005',
                'position' => 'assistant',
                'salary' => 27000,
                'date_joined' => '2023-03-12'
            ]);
            Staff::create([
                'staff_id' => 'ST006',
                'first_name' => 'Chloe',
                'last_name' => 'Bennett',
                'address' => 'London',
                'telephone_no' => '+447700666666',
                'sex' => 'female',
                'dob' => '1996-06-14',
                'nin' => 'NIN006',
                'position' => 'secretary',
                'salary' => 26000,
                'date_joined' => '2023-09-01'
            ]);
            Staff::create([
                'staff_id' => 'ST007',
                'first_name' => 'Ethan',
                'last_name' => 'Scott',
                'address' => 'Manchester',
                'telephone_no' => '+447700777777',
                'sex' => 'male',
                'dob' => '1994-12-08',
                'nin' => 'NIN007',
                'position' => 'assistant',
                'salary' => 28000,
                'date_joined' => '2022-11-15'
            ]);
        }
}

