<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ONOSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ono')->insert([
            [
                'uuid'           => 'ono|3ID',
                'outlet_id'      => '00987537',
                'outlet_name'    => 'Vialli Cell',
                'brand'          => '3ID',
                'actual'         => 10000,
                'flag_mission'   => 1,
                'mission_status' => 0,
            ],
            [
                'uuid'           => 'ono|3ID',
                'outlet_id'      => '0073648',
                'outlet_name'    => 'Riansyah Cell',
                'brand'          => '3ID',
                'actual'         => 130000,
                'flag_mission'   => 1,
                'mission_status' => 1,
            ],
            [
                'uuid'           => 'ono|IM3',
                'outlet_id'      => '12345678',
                'outlet_name'    => 'Hikal cell',
                'brand'          => 'IM3',
                'actual'         => 30000,
                'flag_mission'   => 1,
                'mission_status' => 0,
            ],
            [
                'uuid'           => 'ono|IM3',
                'outlet_id'      => '87654321',
                'outlet_name'    => 'danti cell',
                'brand'          => 'IM3',
                'actual'         => 100000,
                'flag_mission'   => 1,
                'mission_status' => 1,
            ],
        ]);
    }
}
