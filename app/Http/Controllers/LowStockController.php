<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class LowStockController extends Controller
{
public function index()
{
    if (!session()->has('user')) {
        return redirect('/login');
    }

    $outletId = session('user.outlet_id');
    $brand = session('user.brand');

    $uuid = 'low_stock|' . $brand;

    $target = DB::table('low_stock')
        ->join('target', 'low_stock.uuid', '=', 'target.uuid')
        ->where('low_stock.outlet_id', $outletId)
        ->where('low_stock.uuid', $uuid)
        ->first();

    $actual = DB::table('low_stock')
        ->where('outlet_id', $outletId)
        ->first();


    return view('low_stock', compact('target', 'actual'));
}


}
