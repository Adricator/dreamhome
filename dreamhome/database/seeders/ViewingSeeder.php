<?php

namespace Database\Seeders;
use App\Models\Viewing;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ViewingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Viewing::create([
            'viewing_id' => 'V001',
            'client_id' => 'CL001',
            'property_id' => 'PR001',
            'viewing_date' => '2023-10-01',
            'comments' => 'scheduled'
        ]);

        Viewing::create([
            'viewing_id' => 'V002',
            'client_id' => 'CL002',
            'property_id' => 'PR002',
            'viewing_date' => '2023-10-05',
            'comments' => 'completed'
        ]);

        Viewing::create([
            'viewing_id' => 'V003',
            'client_id' => 'CL003',
            'property_id' => 'PR003',
            'viewing_date' => '2023-10-10',
            'comments' => 'cancelled'
        ]);
    }
}
