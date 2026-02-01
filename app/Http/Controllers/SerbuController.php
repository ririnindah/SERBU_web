<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class SerbuController extends Controller
{

    public function index()
    {

        if (!session()->has('user')) {
            return redirect('/login');
        }

        $outletId = session('user.outlet_id');
        $brand = session('user.brand');

        $user = DB::table('serbu_users')
            ->where('outlet_id', $outletId)
            ->first();

        // Konfigurasi semua misi
        $missions = [
            'low_stock' => [
                'flag' => $user->low_stock,
                'table' => 'low_stock',
                'uuid' => 'low_stock|' . $brand,
            ],
            'low_productivity_voucher' => [
                'flag' => $user->low_productivity_voucher,
                'table' => 'low_productivity',
                'uuid' => 'low_productivity_voucher|' . $brand,
            ],
            'low_productivity_rebuy' => [
                'flag' => $user->low_productivity_rebuy,
                'table' => 'low_productivity_rebuys',
                'uuid' => 'low_productivity_rebuy|' . $brand,
            ],
            'high_productivity' => [
                'flag' => $user->high_productivity,
                'table' => 'high_productivity',
                'uuid' => 'high_productivity|' . $brand,
            ],
            'ono' => [
                'flag' => $user->ono,
                'table' => 'ono',
                'uuid' => 'ono|' . $brand,
            ],
        ];

        // Filter misi aktif saja
        $activeMissions = array_filter($missions, function ($mission) {
            return $mission['flag'] == 1;
        });

        // Optimasi: Ambil semua actual dalam satu query union
        $actualQueries = [];
        foreach ($activeMissions as $key => $mission) {
            $actualQueries[] = DB::table($mission['table'])
                ->selectRaw("'{$key}' as mission_key, actual, flag_mission")
                ->where('outlet_id', $outletId);
        }
        $actualResults = collect($actualQueries)->reduce(function ($carry, $query) {
            return $carry ? $carry->unionAll($query) : $query;
        })->get();

        // Map actual berdasarkan mission_key
        $actualData = $actualResults->keyBy('mission_key');

        // Optimasi: Ambil semua target dalam satu query
        $uuids = array_column($activeMissions, 'uuid');
        $targetResults = DB::table('target')
            ->whereIn('uuid', $uuids)
            ->get()
            ->keyBy('uuid');

        // Ambil data misi yang aktif
        $missionData = [];
        foreach ($activeMissions as $key => $mission) {
            $actual = $actualData->get($key);
            $target = $targetResults->get($mission['uuid']);

            // flag mission (1 / 2 / 3)
            $missionFlag = $actual ? ($actual->flag_mission ?? 1) : 1;

            // hitung
            $targetValue = $target ? ($target->{'target' . $missionFlag} ?? 0) : 0;
            $actualValue = $actual ? ($actual->actual ?? 0) : 0;
            $incentive = $target ? ($target->{'incentive' . $missionFlag} ?? 0) : 0;
            $remaining = max($targetValue - $actualValue, 0);

            $missionData[$key] = [
                'remaining' => $remaining,
                'incentive' => $incentive,
            ];
        }

        return view('serbu', compact('user', 'missionData'));
    }

    public function ach()
    {
        // DB::flushQueryLog();
        // DB::enableQueryLog();

        // $start = microtime(true);

        $outletId = session('user.outlet_id');
        $brand = session('user.brand');

        $missions = [
            'low_stock' => ['table' => 'low_stock', 'label' => 'Low Stock'],
            'low_productivity_voucher' => ['table' => 'low_productivity', 'label' => 'Low Productivity Voucher'],
            'low_productivity_rebuy' => ['table' => 'low_productivity_rebuys', 'label' => 'Low Productivity Rebuy'],
            'high_productivity' => ['table' => 'high_productivity', 'label' => 'High Productivity'],
            'ono' => ['table' => 'ono', 'label' => 'ONO'],
        ];

        $achMissions = [];
        $totalIncentiveAch = 0;

        // 🔥 OPTIMASI: Cache maxFlag per outlet dan brand selama 30 menit (asumsi jarang berubah)
        // Ini mengurangi query max() menjadi cache hit jika sudah ada
        $maxFlags = Cache::remember(
            "max_flags:{$outletId}:{$brand}",
            now()->addMinutes(30),
            function () use ($missions, $outletId, $brand) {
                $flags = [];
                foreach ($missions as $key => $mission) {
                    $flags[$key] = DB::table($mission['table'])
                        ->where('outlet_id', $outletId)
                        ->where('brand', $brand)
                        ->max('flag_mission') ?? 0;
                }
                return $flags;
            }
        );

        foreach ($missions as $key => $mission) {
            $maxFlag = $maxFlags[$key] ?? 0;

            if (!$maxFlag || $maxFlag <= 1) {
                continue;
            }

            // 🔥 CACHE TARGET (1 JAM) - tetap dipertahankan
            $uuid = $key . '|' . $brand;

            $target = Cache::remember(
                "target:{$uuid}",
                now()->addHours(1),
                function () use ($uuid) {
                    return DB::table('target')->where('uuid', $uuid)->first();
                }
            );

            if (!$target) continue;

            // 🔥 OPTIMASI: Cache perhitungan incentive per uuid selama 1 jam
            // Ini menghindari loop hitung ulang jika target sudah di-cache
            $incentiveKey = "incentive:{$uuid}:{$maxFlag}";
            $incentiveForMission = Cache::remember(
                $incentiveKey,
                now()->addHours(1),
                function () use ($target, $maxFlag) {
                    $total = 0;
                    for ($level = 1; $level <= ($maxFlag - 1); $level++) {
                        $total += (int) ($target->{'incentive' . $level} ?? 0);
                    }
                    return $total;
                }
            );

            $totalIncentiveAch += $incentiveForMission;

            $achMissions[] = [
                'key' => $key,
                'label' => $mission['label'],
                'max_flag' => (int) $maxFlag,
                'target' => $target,
            ];
        }

        // $time = round((microtime(true) - $start) * 1000, 2);
        // $queries = DB::getQueryLog();

        // dd([
        //     'total_time_ms' => $time,
        //     'total_query' => count($queries),
        //     'queries' => $queries, // hapus kalau kepanjangan
        // ]);

        return view('serbu_ach', compact('achMissions', 'totalIncentiveAch'));
    }

}
