<?php

namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Staff;
use App\Models\Branch;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('staff')->insert([
            // Managers
            [
                'staff_id' => 'ST0001', 'first_name' => 'Joshua', 'last_name' => 'Diaz', 'branch_id' => 'BR001', 'supervised_by' => null,
                'address' => '12 High St, London', 'telephone_no' => '0770-011-1001', 'email' => 'jdiaz@email.com', 'sex' => 'male',
                'dob' => '1980-05-15', 'nin' => 'AB4567ER', 'position' => 'manager', 'salary' => 45000.00, 'date_hired' => '2015-01-10',
                'car_allowance' => 2000.00, 'performance_bonus' => 5000.00, 'date_promoted' => null, 'typing_speed_wpm' => null, 'password' => Hash::make('dreamhome123')
            ],
            [
                'staff_id' => 'ST0002', 'first_name' => 'Alforque', 'last_name' => 'Adrianne', 'branch_id' => 'BR002', 'supervised_by' => null,
                'address' => '45 Baker St, Glasgow', 'telephone_no' => '0770-022-2002', 'email' => 'addianne.alforque@email.com', 'sex' => 'female',
                'dob' => '1985-08-22', 'nin' => 'CD8901IT', 'position' => 'manager', 'salary' => 45000.00, 'date_hired' => '2016-03-12',
                'car_allowance' => 2000.00, 'performance_bonus' => 5000.00, 'date_promoted' => null, 'typing_speed_wpm' => null, 'password' => Hash::make('dreamhome123')
            ],
            [
                'staff_id' => 'ST0003', 'first_name' => 'Joshua Marc', 'last_name' => 'Layong', 'branch_id' => 'BR003', 'supervised_by' => null,
                'address' => '88 Deansgate, Manchester', 'telephone_no' => '0770-033-3003', 'email' => 'joshmarc@email.com', 'sex' => 'male',
                'dob' => '1978-11-30', 'nin' => 'EF2345UK', 'position' => 'manager', 'salary' => 45000.00, 'date_hired' => '2014-06-01',
                'car_allowance' => 2000.00, 'performance_bonus' => 5000.00, 'date_promoted' => null, 'typing_speed_wpm' => null , 'password' => Hash::make('dreamhome123')
            ],

            // Branch 1 Supervisors
            [
                'staff_id' => 'ST0004', 'first_name' => 'Sarah', 'last_name' => 'Jenkins', 'branch_id' => 'BR001', 'supervised_by' => 'ST0001',
                'address' => '12 Abbey Rd, London', 'telephone_no' => '0770-011-4004', 'email' => 'sjenk@email.com', 'sex' => 'female',
                'dob' => '1990-01-05', 'nin' => 'GH5566AA', 'position' => 'supervisor', 'salary' => 32000.00, 'date_hired' => '2018-03-01',
                'car_allowance' => null, 'performance_bonus' => null, 'date_promoted' => null, 'typing_speed_wpm' => null , 'password' => Hash::make('dreamhome123')
            ],
            [
                'staff_id' => 'ST0005', 'first_name' => 'David', 'last_name' => 'Okonkwo', 'branch_id' => 'BR001', 'supervised_by' => 'ST0001',
                'address' => '45 Baker St, London', 'telephone_no' => '0770-011-5005', 'email' => 'dokon@email.com', 'sex' => 'male',
                'dob' => '1988-07-19', 'nin' => 'IJ7788BB', 'position' => 'supervisor', 'salary' => 32000.00, 'date_hired' => '2018-04-10',
                'car_allowance' => null, 'performance_bonus' => null, 'date_promoted' => null, 'typing_speed_wpm' => null , 'password' => Hash::make('dreamhome123')
            ],

            // Branch 2 Supervisors
            [
                'staff_id' => 'ST0006', 'first_name' => 'Fiona', 'last_name' => 'McLeod', 'branch_id' => 'BR002', 'supervised_by' => 'ST0002',
                'address' => '10 Sauchiehall St, Glasgow', 'telephone_no' => '0770-011-6006', 'email' => 'fmcleod@email.com', 'sex' => 'female',
                'dob' => '1992-12-12', 'nin' => 'KL9900CC', 'position' => 'supervisor', 'salary' => 31000.00, 'date_hired' => '2019-01-20',
                'car_allowance' => null, 'performance_bonus' => null, 'date_promoted' => null, 'typing_speed_wpm' => null , 'password' => Hash::make('dreamhome123')
            ],
            [
                'staff_id' => 'ST0007', 'first_name' => 'Ian', 'last_name' => 'Wright', 'branch_id' => 'BR002', 'supervised_by' => 'ST0002',
                'address' => '31 Buchanan St, Glasgow', 'telephone_no' => '0770-011-7007', 'email' => 'iwright@email.com', 'sex' => 'male',
                'dob' => '1991-05-25', 'nin' => 'MN1122DD', 'position' => 'supervisor', 'salary' => 31000.00, 'date_hired' => '2019-02-15',
                'car_allowance' => null, 'performance_bonus' => null, 'date_promoted' => null, 'typing_speed_wpm' => null, 'password' => Hash::make('dreamhome123')
            ],

            // Branch 3 Supervisors
            [
                'staff_id' => 'ST0008', 'first_name' => 'Grace', 'last_name' => 'Kim', 'branch_id' => 'BR003', 'supervised_by' => 'ST0003',
                'address' => '15 Deansgate, Manchester', 'telephone_no' => '0770-011-8008', 'email' => 'gkim@email.com', 'sex' => 'female',
                'dob' => '1993-09-09', 'nin' => 'OP3344EE', 'position' => 'supervisor', 'salary' => 31500.00, 'date_hired' => '2019-06-05',
                'car_allowance' => null, 'performance_bonus' => null, 'date_promoted' => null, 'typing_speed_wpm' => null, 'password' => Hash::make('dreamhome123')
            ],
            [
                'staff_id' => 'ST0009', 'first_name' => 'Liam', 'last_name' => 'Gallagher', 'branch_id' => 'BR003', 'supervised_by' => 'ST0003',
                'address' => '20 Wilmslow Rd, Manchester', 'telephone_no' => '0770-011-9009', 'email' => 'lgall@email.com', 'sex' => 'male',
                'dob' => '1989-02-14', 'nin' => 'QR5566FF', 'position' => 'supervisor', 'salary' => 31500.00, 'date_hired' => '2019-08-12',
                'car_allowance' => null, 'performance_bonus' => null, 'date_promoted' => null, 'typing_speed_wpm' => null, 'password' => Hash::make('dreamhome123')
            ],

            // Secretaries
            [
                'staff_id' => 'ST0010', 'first_name' => 'Alice', 'last_name' => 'Smyth', 'branch_id' => 'BR001', 'supervised_by' => 'ST0004',
                'address' => 'London Flat 1', 'telephone_no' => '0770-022-1010', 'email' => 'asmyth@email.com', 'sex' => 'female',
                'dob' => '1995-04-10', 'nin' => 'ST1111AA', 'position' => 'secretary', 'salary' => 25000.00, 'date_hired' => '2020-01-05',
                'car_allowance' => null, 'performance_bonus' => null, 'date_promoted' => null, 'typing_speed_wpm' => 65, 'password' => Hash::make('dreamhome123')
            ],
            [
                'staff_id' => 'ST0011', 'first_name' => 'Bob', 'last_name' => 'Miller', 'branch_id' => 'BR001', 'supervised_by' => 'ST0005',
                'address' => 'London Flat 2', 'telephone_no' => '0770-022-1011', 'email' => 'bmiller@email.com', 'sex' => 'male',
                'dob' => '1996-06-15', 'nin' => 'ST2222BB', 'position' => 'secretary', 'salary' => 25000.00, 'date_hired' => '2020-02-10',
                'car_allowance' => null, 'performance_bonus' => null, 'date_promoted' => null, 'typing_speed_wpm' => 70, 'password' => Hash::make('dreamhome123')
            ],
            [
                'staff_id' => 'ST0012', 'first_name' => 'Chloe', 'last_name' => 'Tan', 'branch_id' => 'BR002', 'supervised_by' => 'ST0006',
                'address' => 'Glasgow Flat 1', 'telephone_no' => '0770-022-1012', 'email' => 'ctan@email.com', 'sex' => 'female',
                'dob' => '1994-08-20', 'nin' => 'ST3333CC', 'position' => 'secretary', 'salary' => 24500.00, 'date_hired' => '2020-03-15',
                'car_allowance' => null, 'performance_bonus' => null, 'date_promoted' => null, 'typing_speed_wpm' => 80, 'password' => Hash::make('dreamhome123')
            ],
            [
                'staff_id' => 'ST0013', 'first_name' => 'Dan', 'last_name' => 'Lee', 'branch_id' => 'BR002', 'supervised_by' => 'ST0007',
                'address' => 'Glasgow Flat 2', 'telephone_no' => '0770-022-1013', 'email' => 'dlee@email.com', 'sex' => 'male',
                'dob' => '1997-10-25', 'nin' => 'ST4444DD', 'position' => 'secretary', 'salary' => 24500.00, 'date_hired' => '2020-04-20',
                'car_allowance' => null, 'performance_bonus' => null, 'date_promoted' => null, 'typing_speed_wpm' => 75, 'password' => Hash::make('dreamhome123')
            ],
            [
                'staff_id' => 'ST0014', 'first_name' => 'Eve', 'last_name' => 'White', 'branch_id' => 'BR003', 'supervised_by' => 'ST0008',
                'address' => 'Manchester Flat 1', 'telephone_no' => '0770-022-1014', 'email' => 'ewhite@email.com', 'sex' => 'female',
                'dob' => '1998-12-30', 'nin' => 'ST5555EE', 'position' => 'secretary', 'salary' => 24800.00, 'date_hired' => '2020-05-25',
                'car_allowance' => null, 'performance_bonus' => null, 'date_promoted' => null, 'typing_speed_wpm' => 68, 'password' => Hash::make('dreamhome123')
            ],
            [
                'staff_id' => 'ST0015', 'first_name' => 'Frank', 'last_name' => 'Black', 'branch_id' => 'BR003', 'supervised_by' => 'ST0009',
                'address' => 'Manchester Flat 2', 'telephone_no' => '0770-022-1015', 'email' => 'fblack@email.com', 'sex' => 'male',
                'dob' => '1999-01-05', 'nin' => 'ST6666FF', 'position' => 'secretary', 'salary' => 24800.00, 'date_hired' => '2020-06-30',
                'car_allowance' => null, 'performance_bonus' => null, 'date_promoted' => null, 'typing_speed_wpm' => 72, 'password' => Hash::make('dreamhome123')
            ],

            // General Staff
            [
                'staff_id' => 'ST0016', 'first_name' => 'John', 'last_name' => 'Doe', 'branch_id' => 'BR001', 'supervised_by' => 'ST0004',
                'address' => 'Street 1, London', 'telephone_no' => '0770-033-0016', 'email' => 'jdoe@email.com', 'sex' => 'male',
                'dob' => '2000-01-01', 'nin' => 'AA0016ZZ', 'position' => 'staff', 'salary' => 20000.00, 'date_hired' => '2023-01-01',
                'car_allowance' => null, 'performance_bonus' => null, 'date_promoted' => null, 'typing_speed_wpm' => null, 'password' => Hash::make('dreamhome123')
            ],
            [
                'staff_id' => 'ST0017', 'first_name' => 'Jane', 'last_name' => 'Doe', 'branch_id' => 'BR001', 'supervised_by' => 'ST0004',
                'address' => 'Street 2, London', 'telephone_no' => '0770-033-0017', 'email' => 'jadoe@email.com', 'sex' => 'female',
                'dob' => '2001-02-02', 'nin' => 'BB0017YY', 'position' => 'staff', 'salary' => 20000.00, 'date_hired' => '2023-01-01',
                'car_allowance' => null, 'performance_bonus' => null, 'date_promoted' => null, 'typing_speed_wpm' => null, 'password' => Hash::make('dreamhome123')
            ],
            [
                'staff_id' => 'ST0018', 'first_name' => 'Sam', 'last_name' => 'Smith', 'branch_id' => 'BR001', 'supervised_by' => 'ST0004',
                'address' => 'Street 3, London', 'telephone_no' => '0770-033-0018', 'email' => 'ssmith@email.com', 'sex' => 'male',
                'dob' => '2002-03-03', 'nin' => 'CC0018XX', 'position' => 'staff', 'salary' => 20000.00, 'date_hired' => '2023-01-01',
                'car_allowance' => null, 'performance_bonus' => null, 'date_promoted' => null, 'typing_speed_wpm' => null, 'password' => Hash::make('dreamhome123')
            ],
            [
                'staff_id' => 'ST0019', 'first_name' => 'Pam', 'last_name' => 'Bee', 'branch_id' => 'BR001', 'supervised_by' => 'ST0004',
                'address' => 'Street 4, London', 'telephone_no' => '0770-033-0019', 'email' => 'pbee@email.com', 'sex' => 'female',
                'dob' => '2000-04-04', 'nin' => 'DD0019WW', 'position' => 'staff', 'salary' => 20000.00, 'date_hired' => '2023-01-01',
                'car_allowance' => null, 'performance_bonus' => null, 'date_promoted' => null, 'typing_speed_wpm' => null, 'password' => Hash::make('dreamhome123')
            ],
            [
                'staff_id' => 'ST0020', 'first_name' => 'Tim', 'last_name' => 'Cook', 'branch_id' => 'BR001', 'supervised_by' => 'ST0004',
                'address' => 'Street 5, London', 'telephone_no' => '0770-033-0020', 'email' => 'tcook@email.com', 'sex' => 'male',
                'dob' => '2001-05-05', 'nin' => 'EE0020VV', 'position' => 'staff', 'salary' => 20000.00, 'date_hired' => '2023-01-01',
                'car_allowance' => null, 'performance_bonus' => null, 'date_promoted' => null, 'typing_speed_wpm' => null, 'password' => Hash::make('dreamhome123')
            ],
        ]); 
    }
}

