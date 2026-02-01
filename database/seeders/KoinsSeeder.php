<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KoinsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('koins')->insert([
            [
                'outlet_id' => '00987537',
                'brand'     => '3ID',
                'koin'      => 1200000,
            ],
            [
                'outlet_id' => '0073648',
                'brand'     => '3ID',
                'koin'      => 1000000,
            ],
            [
                'outlet_id' => '12345678',
                'brand'     => 'IM3',
                'koin'      => 10000,
            ],
            [
                'outlet_id' => '87654321',
                'brand'     => 'IM3',
                'koin'      => 50000,
            ],
        ]);
    }
}
