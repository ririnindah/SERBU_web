<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SerbuUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('serbu_users')->insert([
            [
                'outlet_id'           => '00987537',
                'outlet_name'         => 'Vialli Cell',
                'brand'               => '3ID',
                'hit'                 => 0,
                'low_stock'           => 1,
                'low_productivity'    => 1,
                'high_productivity'   => 1,
                'ono'                 => 1,
                'schema5'             => 0,
                'schema6'             => 0,
                'schema7'             => 0,
            ],
            [
                'outlet_id'           => '0073648',
                'outlet_name'         => 'Riansyah Cell',
                'brand'               => '3ID',
                'hit'                 => 0,
                'low_stock'           => 1,
                'low_productivity'    => 0,
                'high_productivity'   => 1,
                'ono'                 => 0,
                'schema5'             => 0,
                'schema6'             => 0,
                'schema7'             => 0,
            ],
            [
                'outlet_id'           => '12345678',
                'outlet_name'         => 'Hikal Cell',
                'brand'               => 'IM3',
                'hit'                 => 0,
                'low_stock'           => 1,
                'low_productivity'    => 0,
                'high_productivity'   => 0,
                'ono'                 => 0,
                'schema5'             => 0,
                'schema6'             => 0,
                'schema7'             => 0,
            ],
            [
                'outlet_id'           => '87654321',
                'outlet_name'         => 'Danti Cell',
                'brand'               => 'IM3',
                'hit'                 => 0,
                'low_stock'           => 1,
                'low_productivity'    => 1,
                'high_productivity'   => 1,
                'ono'                 => 0,
                'schema5'             => 0,
                'schema6'             => 0,
                'schema7'             => 0,
            ],
        ]);
    }
}
