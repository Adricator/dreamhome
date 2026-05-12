<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
{
  $this->call([
    // 1. Level One: Independent tables (Foundation)
    BranchSeeder::class,        
    OwnerSeeder::class,  
    ClientSeeder::class,        

    // 2. Level Two: Depends on Branches
    StaffSeeder::class,         
    // ManagerSeeder::class, (If you have one, place it here)
    
    // 3. Level Three: Depends on Staff, Owners, and Branches
    PropertySeeder::class,      

    // 4. Level Four: Depends on Properties and Clients
    AdvertisementSeeder::class,
    LeaseSeeder::class,
    InspectionSeeder::class,
    ViewingSeeder::class,
    
    // 5. Specialized Staff roles
    SecretarySeeder::class,
]);
    }
}       
