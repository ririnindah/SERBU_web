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
        if (!session()->has('user')) {
            return redirect('/login');
        }

        $outletId = session('user.outlet_id');
        $brand = session('user.brand');

        $uuid = 'high_productivity|' . $brand;

        $target = DB::table('high_productivity')
            ->join('target', 'high_productivity.uuid', '=', 'target.uuid')
            ->where('high_productivity.outlet_id', $outletId)
            ->where('high_productivity.uuid', $uuid)
            ->first();

        $actual = DB::table('high_productivity')
            ->where('outlet_id', $outletId)
            ->first();

        return view('high_productivity', compact('target', 'actual'));
    }

}
