<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HighProductivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('high_productivity')->insert([
            [
                'uuid'           => 'high_productivity|3ID',
                'outlet_id'      => '00987537',
                'outlet_name'    => 'Vialli Cell',
                'brand'          => '3ID',
                'actual'         => 150000,
                'flag_mission'   => 4,
                'mission_status' => 0,
            ],
            [
                'uuid'           => 'high_productivity|3ID',
                'outlet_id'      => '0073648',
                'outlet_name'    => 'Riansyah Cell',
                'brand'          => '3ID',
                'actual'         => 130000,
                'flag_mission'   => 1,
                'mission_status' => 1,
            ],
            [
                'uuid'           => 'high_productivity|IM3',
                'outlet_id'      => '12345678',
                'outlet_name'    => 'Hikal cell',
                'brand'          => 'IM3',
                'actual'         => 310000,
                'flag_mission'   => 3,
                'mission_status' => 0,
            ],
            [
                'uuid'           => 'high_productivity|IM3',
                'outlet_id'      => '87654321',
                'outlet_name'    => 'danti cell',
                'brand'          => 'IM3',
                'actual'         => 150000,
                'flag_mission'   => 2,
                'mission_status' => 1,
            ],
        ]);
    }
}
