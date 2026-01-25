<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class SerbuController extends Controller
{
    public function index()
    {
        if (!session()->has('user')) {
            return redirect('/login');
        }

        $outletId = session('user.outlet_id');
        $brand    = session('user.brand');

        $user = DB::table('serbu_users')
            ->where('outlet_id', $outletId)
            ->first();

        // 🔹 Konfigurasi semua misi
        $missions = [
            'low_stock' => [
                'flag'  => $user->low_stock,
                'table' => 'low_stock',
                'uuid'  => 'low_stock|' . $brand,
            ],
            'low_productivity' => [
                'flag'  => $user->low_productivity,
                'table' => 'low_productivity',
                'uuid'  => 'low_productivity|' . $brand,
            ],
            'high_productivity' => [
                'flag'  => $user->high_productivity, // ✅ FIX
                'table' => 'high_productivity',
                'uuid'  => 'high_productivity|' . $brand,
            ],
            'ono' => [
                'flag'  => $user->ono,
                'table' => 'ono',
                'uuid'  => 'ono|' . $brand,
            ],
        ];

        // 🔹 Ambil data misi yang aktif
        $missionData = [];

        foreach ($missions as $key => $mission) {

            // hanya misi aktif
            if ($mission['flag'] != 1) {
                continue;
            }

            // actual
            $actual = DB::table($mission['table'])
                ->where('outlet_id', $outletId)
                ->first();

            // target
            $target = DB::table($mission['table'])
                ->join('target', $mission['table'].'.uuid', '=', 'target.uuid')
                ->where($mission['table'].'.outlet_id', $outletId)
                ->where($mission['table'].'.uuid', $mission['uuid'])
                ->first();

            // flag mission (1 / 2 / 3)
            $missionFlag = $actual->flag_mission ?? 1;

            // hitung
            $targetValue = $target->{'target'.$missionFlag} ?? 0;
            $actualValue = $actual->actual ?? 0;
            $incentive   = $target->{'incentive'.$missionFlag} ?? 0;
            $remaining   = max($targetValue - $actualValue, 0);

            // simpan data SIAP PAKAI
            $missionData[$key] = [
                'remaining' => $remaining,
                'incentive' => $incentive,
            ];
        }


        // 🔹 Kirim ke Blade
        return view('serbu', compact('user', 'missionData'));
    }

    public function ach()
    {
        $outletId = session('user.outlet_id');
        $brand    = session('user.brand');

        $missions = [
            'low_stock' => ['table' => 'low_stock', 'label' => 'Low Stock'],
            'low_productivity' => ['table' => 'low_productivity', 'label' => 'Low Productivity'],
            'high_productivity' => ['table' => 'high_productivity', 'label' => 'High Productivity'],
            'ono' => ['table' => 'ono', 'label' => 'ONO'],
        ];

        $achMissions = [];
        $totalIncentiveAch = 0;

        foreach ($missions as $key => $mission) {
            // ambil level tertinggi flag_mission untuk outlet+brand
            $maxFlag = DB::table($mission['table'])
                ->where('outlet_id', $outletId)
                ->where('brand', $brand)
                ->max('flag_mission'); // contoh: 4

            // kalau belum ada / belum mencapai level 2, berarti belum ada ACH level
            if (!$maxFlag || $maxFlag <= 1) {
                continue;
            }

            // ambil konfigurasi target & incentive
            $uuid = $key . '|' . $brand; // contoh: high_productivity|3ID
            $target = DB::table('target')->where('uuid', $uuid)->first();

            if (!$target) continue;

            for ($level = 1; $level <= ($maxFlag - 1); $level++) {
                $totalIncentiveAch += $target->{'incentive'.$level} ?? 0;
            }

            $achMissions[] = [
                'key'      => $key,
                'label'    => $mission['label'],
                'max_flag' => (int) $maxFlag,  // misal 4
                'target'   => $target,         // punya target1..3 & incentive1..3
            ];
        }

        return view('serbu_ach', compact('achMissions', 'totalIncentiveAch'));
    }


}
