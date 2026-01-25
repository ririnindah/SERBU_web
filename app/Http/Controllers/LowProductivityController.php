<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class LowProductivityController extends Controller
{
    public function index()
    {
        if (!session()->has('user')) {
            return redirect('/login');
        }

        $outletId = session('user.outlet_id');
        $brand = session('user.brand');

        $uuid = 'low_productivity|' . $brand;

        $target = DB::table('low_productivity')
            ->join('target', 'low_productivity.uuid', '=', 'target.uuid')
            ->where('low_productivity.outlet_id', $outletId)
            ->where('low_productivity.uuid', $uuid)
            ->first();

        $actual = DB::table('low_productivity')
            ->where('outlet_id', $outletId)
            ->first();

        return view('low_productivity', compact('target', 'actual'));
    }
}
