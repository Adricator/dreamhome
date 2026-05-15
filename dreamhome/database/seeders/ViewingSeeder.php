<?php

namespace Database\Seeders;
use App\Models\Viewing;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ViewingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('viewings')->insert([
            [
                'client_id'   => 'CL001', // Make sure this matches a client_id in your 'clients' table
                'property_id' => 'PR001', // Make sure this matches a property_id in your 'properties' table
                'view_date'   => '2026-05-10',
                'staff_id'    => 'ST0016', // Matches John Doe from your staff data
                'comments'    => 'Client liked the spacious living room, but wants a larger kitchen.',
            ],
            [
                'client_id'   => 'CL002',
                'property_id' => 'PR001', // Multiple clients can view the same property
                'view_date'   => '2026-05-11',
                'staff_id'    => 'ST0017', // Matches Jane Doe from your staff data
                'comments'    => 'Found the neighborhood too noisy.',
            ],
            [
                'client_id'   => 'CL001', // Same client viewing a different property
                'property_id' => 'PR002',
                'view_date'   => '2026-05-12',
                'staff_id'    => 'ST0016',
                'comments'    => null, // This is allowed because comments are ->nullable()
            ],
            [
                'client_id'   => 'CL003',
                'property_id' => 'PR003',
                'view_date'   => '2026-05-14',
                'staff_id'    => 'ST0018', // Matches Sam Smith from your staff data
                'comments'   => 'Thinking about making an offer soon.',
            ],
        ]);
    }
}