<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KroGoldController extends Controller
{
    public function index()
    {
        if (!session()->has('user')) {
            return redirect('/login');
        }

        $outletId = session('user.outlet_id');
        $brand = session('user.brand');
        $uuid = 'kro_gold|' . $brand;

        return view('kro_gold');
    }
}
