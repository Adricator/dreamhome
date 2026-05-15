<?php

namespace Database\Seeders;

use App\Models\Payment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Payment::create([
            'payment_no' => '1',
            'lease_id' => 'LE001',
            'payment_date' => '2023-01-01',
            'amount' => 1200.00,
            'payment_method' => 'credit_card'
        ]);
        Payment::create([
            'payment_no' => '2',
            'lease_id' => 'LE002',
            'payment_date' => '2023-02-01',
            'amount' => 1300.00,
            'payment_method' => 'debit_card'
        ]); 
    }
}
