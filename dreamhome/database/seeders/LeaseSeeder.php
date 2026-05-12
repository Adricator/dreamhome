<?php

namespace Database\Seeders;
use App\Models\Lease;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LeaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Lease::create([
            'lease_id' => 'LE001',
            'property_id' => 'PR001',
            'client_id' => 'CLI001',
            'payment_method' => 'credit_card',
            'deposit' => 1200.00,
            'deposit_paid' => true,
            'staff_id' => 'ST001',
            'start_date' => '2024-06-01',
            'end_date' => '2025-05-31',
            'duration_months' => 12,
        ]);

        Lease::create([
            'lease_id' => 'LE002',
            'property_id' => 'PR002',
            'client_id' => 'CLI002',
            'payment_method' => 'debit_card',
            'deposit' => 1500.00,
            'deposit_paid' => true,
            'staff_id' => 'ST002',
            'start_date' => '2024-07-01',
            'end_date' => '2025-06-30',
            'duration_months' => 12,
        ]);

        Lease::create([
            'lease_id' => 'LE003',
            'property_id' => 'PR003',
            'client_id' => 'CLI003',
            'payment_method' => 'bank_transfer',
            'deposit' => 1000.00,
            'deposit_paid' => true,                     
            'staff_id' => 'ST003',
            'start_date' => '2024-08-01',
            'end_date' => '2025-07-31',
            'duration_months' => 12
        ]);

        Lease::create([
            'lease_id' => 'LE004',
            'property_id' => 'PR004',
            'client_id' => 'CLI004',
            'payment_method' => 'cash',
            'deposit' => 1300.00,
            'deposit_paid' => true, 
            'staff_id' => 'ST004',
            'start_date' => '2024-09-01',
            'end_date' => '2025-08-31',
            'duration_months' => 12
        ]);

        Lease::create([
            'lease_id' => 'LE005',
            'property_id' => 'PR005',
            'client_id' => 'CLI005',
            'payment_method' => 'credit_card',
            'deposit' => 1100.00,
            'deposit_paid' => true,
            'staff_id' => 'ST005',
            'start_date' => '2024-10-01',
            'end_date' => '2025-09-30',
            'duration_months' => 12
        ]);
    }
}
