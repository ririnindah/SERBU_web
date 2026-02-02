<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class HighProductivityController extends Controller
{
    public function index()
    {

        // DB::flushQueryLog();
        // DB::enableQueryLog();

        // $start = microtime(true);

        if (!session()->has('user')) {
            return redirect('/login');
        }

        $outletId = session('user.outlet_id');
        $brand = session('user.brand');

        $uuid = 'high_productivity|' . $brand;

        $target = DB::table('target')
            ->where('uuid', $uuid)
            ->first();

        $actual = DB::table('high_productivity')
        ->where('outlet_id', $outletId)
        ->first();

        // $time = round((microtime(true) - $start) * 1000, 2);
        // $queries = DB::getQueryLog();

        // dd([
        //     'total_time_ms' => $time,
        //     'total_query' => count($queries),
        //     'queries' => $queries, // hapus kalau kepanjangan
        // ]);

        return view('high_productivity', compact('target', 'actual'));
    }

}
