<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LowProductivityRebuySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('low_productivity_rebuys')->insert([
        [
            'uuid'           => 'low_productivity_rebuy|3ID',
            'outlet_id'      => '00987537',
            'outlet_name'    => 'Vialli Cell',
            'brand'          => '3ID',
            'actual'         => 100000,
            'flag_mission'   => 1,
            'mission_status' => 0,
        ],
        [
            'uuid'           => 'low_productivity_rebuy|3ID',
            'outlet_id'      => '0073648',
            'outlet_name'    => 'Riansyah Cell',
            'brand'          => '3ID',
            'actual'         => 200000,
            'flag_mission'   => 3,
            'mission_status' => 1,
        ],
        [
            'uuid'           => 'low_productivity_rebuy|IM3',
            'outlet_id'      => '12345678',
            'outlet_name'    => 'Hikal cell',
            'brand'          => 'IM3',
            'actual'         => 300000,
            'flag_mission'   => 1,
            'mission_status' => 0,
        ],
        [
            'uuid'           => 'low_productivity_rebuy|IM3',
            'outlet_id'      => '87654321',
            'outlet_name'    => 'danti cell',
            'brand'          => 'IM3',
            'actual'         => 400000,
            'flag_mission'   => 1,
            'mission_status' => 1,
        ],
        ]);
    }
}
