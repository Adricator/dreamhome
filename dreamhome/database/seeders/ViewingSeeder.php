<?php

namespace Database\Seeders;

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
                'viewing_id'  => 'V001',
                'client_id'   => 'CL001',
                'property_id' => 'PR001',
                'view_date'   => '2026-05-10 10:00:00',
                'staff_id'    => 'ST0016',
                'comments'    => 'Client liked the spacious living room, but wants a larger kitchen.',
                'status'      => 'pending',
            ],
            [
                'viewing_id'  => 'V002',
                'client_id'   => 'CL002',
                'property_id' => 'PR001',
                'view_date'   => '2026-05-11 11:00:00',
                'staff_id'    => 'ST0017',
                'comments'    => 'Found the neighborhood too noisy.',
                'status'      => 'pending',
            ],
            [
                'viewing_id'  => 'V003',
                'client_id'   => 'CL001',
                'property_id' => 'PR002',
                'view_date'   => '2026-05-12 09:00:00',
                'staff_id'    => 'ST0016',
                'comments'    => null,
                'status'      => 'pending',
            ],
            [
                'viewing_id'  => 'V004',
                'client_id'   => 'CL003',
                'property_id' => 'PR003',
                'view_date'   => '2026-05-14 02:00:00',
                'staff_id'    => 'ST0018',
                'comments'    => 'Thinking about making an offer soon.',
                'status'      => 'pending',
            ],
        ]);
    }
}