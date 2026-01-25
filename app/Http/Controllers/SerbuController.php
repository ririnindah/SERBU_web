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
}
