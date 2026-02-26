<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IncentivesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('incentives')->insert([
            [
                'outlet_id' => '00987537',
                'brand'     => '3ID',
                'incentive'      => 120000,
            ],
            [
                'outlet_id' => '0073648',
                'brand'     => '3ID',
                'incentive'      => 100000,
            ],
            [
                'outlet_id' => '12345678',
                'brand'     => 'IM3',
                'incentive'      => 1000,
            ],
            [
                'outlet_id' => '87654321',
                'brand'     => 'IM3',
                'incentive'      => 5000,
            ],
        ]);
    }
}
