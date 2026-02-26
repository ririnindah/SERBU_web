<?php

namespace App\Http\Controllers;

use App\Models\KroTurs; 
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class KroTursController extends Controller
{
    public function index()
    {
        if (!session()->has('user')) {
            return redirect('/login');
        }

        $outletId = session('user.outlet_id');
        $brand = session('user.brand');
        $uuid = 'kro_turs|' . $brand;

        $incentive = DB::table('incentives')
                ->where('outlet_id', $outletId)
                ->where('brand', $brand) 
                ->value('incentive') ?? 0;

        $maxHit = DB::table('target')
            ->where('uuid', $uuid)
            ->value('target1') ?? 0;

        $actual = DB::table('kro_turs')
            ->where('outlet_id', $outletId)
            ->where('brand', $brand) 
            ->first();

        return view('kro_turs', compact('incentive', 'maxHit', 'actual'));
    }
}
