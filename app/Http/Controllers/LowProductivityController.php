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

        $uuid = 'low_productivity_voucher|' . $brand;

        $target = DB::table('target')
            ->where('uuid', $uuid)
            ->first();

        $actual = DB::table('low_productivity')
            ->where('outlet_id', $outletId)
            ->first();

        return view('low_productivity_voucher', compact('target', 'actual'));
    }
}
