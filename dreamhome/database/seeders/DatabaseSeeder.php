<?php

namespace Database\Seeders;
use App\Models\Branch;
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
            BranchSeeder::class,        
            StaffSeeder::class,
            ClientSeeder::class,
            OwnerSeeder::class,
            NextOfKinSeeder::class,
            PropertySeeder::class,
            InspectionSeeder::class,
            AdvertisementSeeder::class,
            LeaseSeeder::class,
            PaymentSeeder::class,
            ViewingSeeder::class,
         
        ]);

        
        Branch::where('branch_id', 'BR001')->update(['manager_id' => 'ST0001']);
        Branch::where('branch_id', 'BR002')->update(['manager_id' => 'ST0002']);
        Branch::where('branch_id', 'BR003')->update(['manager_id' => 'ST0003']);
    }
}       
