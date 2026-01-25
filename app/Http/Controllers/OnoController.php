<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class OnoController extends Controller
{
    public function index()
    {
        if (!session()->has('user')) {
            return redirect('/login');
        }

        $outletId = session('user.outlet_id');
        $brand = session('user.brand');

        $uuid = 'ono|' . $brand;

        $target = DB::table('ono')
            ->join('target', 'ono.uuid', '=', 'target.uuid')
            ->where('ono.outlet_id', $outletId)
            ->where('ono.uuid', $uuid)
            ->first();

        $actual = DB::table('ono')
            ->where('outlet_id', $outletId)
            ->first();

        return view('ono', compact('target', 'actual'));
    }
}
