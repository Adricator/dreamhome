<?php

namespace Database\Seeders;

use App\Models\Secretary;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SecretarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Secretary::create([
            'staff_id' => 'ST006',
            'typing_speed' => 80,
        ]);
    }
}
