<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class LowProductivityRebuyController extends Controller
{
        public function index()
    {
        if (!session()->has('user')) {
            return redirect('/login');
        }

        $outletId = session('user.outlet_id');
        $brand = session('user.brand');

        $uuid = 'low_productivity_rebuy|' . $brand;

        $target = DB::table('target')
            ->where('uuid', $uuid)
            ->first();

        $actual = DB::table('low_productivity_rebuys')
            ->where('outlet_id', $outletId)
            ->first();

        return view('low_productivity_rebuy', compact('target', 'actual'));
    }
}
