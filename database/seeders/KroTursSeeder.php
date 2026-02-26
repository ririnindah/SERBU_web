<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KroTursSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kro_turs')->insert([
            [
                'as_of' => '2026-02-20',
                'outlet_id'      => '00987537',
                'outlet_name'    => 'Vialli Cell',
                'brand'          => '3ID',
                'hit'   => 50,
                'amount' => 2400000,
            ],
        ]);
    }
}
