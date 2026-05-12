<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Property;

class PropertySeeder extends Seeder
{
    public function run(): void
    {
        Property::create([
            'property_id' => 'PR001',
            'owner_id' => 'OWN001',
            'branch_id' => 'BR001',
            'staff_id' => 'ST001',
            'street' => '221B Baker Street',
            'area' => 'Marylebone',
            'city' => 'London',
            'postcode' => 'NW1 6XE',
            'type' => 'Apartment',
            'rooms' => 3,
            'monthly_rent' => 2500,
            'status' => 'available'
        ]);

        Property::create([
            'property_id' => 'PR002',
            'owner_id' => 'OWN002',
            'branch_id' => 'BR002',
            'staff_id' => 'ST002',
            'street' => '50 Deansgate',
            'area' => 'City Centre',
            'city' => 'Manchester',
            'postcode' => 'M3 2BW',
            'type' => 'Condo',
            'rooms' => 2,
            'monthly_rent' => 1800,
            'status' => 'rented'
        ]);
        
        Property::create([
            'property_id' => 'PR003',
            'owner_id' => 'OWN003',
            'branch_id' => 'BR003',
            'staff_id' => 'ST003',
            'street' => '10 Princes Street',
            'area' => 'Old Town',
            'city' => 'Edinburgh',
            'postcode' => 'EH2 2ER',
            'type' => 'House',
            'rooms' => 4,
            'monthly_rent' => 3200,
            'status' => 'maintenance'
        ]);

        Property::create([
            'property_id' => 'PR004',
            'owner_id' => 'OWN004',
            'branch_id' => 'BR004',
            'staff_id' => 'ST004',
            'street' => '5 Broad Street',
            'area' => 'Central',
            'city' => 'Birmingham',
            'postcode' => 'B1 2HF',
            'type' => 'Apartment',
            'rooms' => 3,
            'monthly_rent' => 2200,
            'status' => 'reserved'
        ]);

    }
}