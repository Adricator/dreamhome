<?php

namespace Database\Seeders;
use App\Models\Advertisement;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdvertisementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Advertisement::create([
            'ad_id' => 'AD001',
            'property_id' => 'PR001',
            'media_source' => 'Online',
            'date_advertised' => '2024-06-01',
            'cost' => 500.00
        ]);
        Advertisement::create([
            'ad_id' => 'AD002',
            'property_id' => 'PR002',
            'media_source' => 'Newspaper',
            'date_advertised' => '2024-06-05',
            'cost' => 300.00
        ]);
        Advertisement::create([
            'ad_id' => 'AD003',
            'property_id' => '',
            'media_source' => 'Online',
            'date_advertised' => '2024-06-10',
            'cost' => 450.00                        
        ]);
}

}