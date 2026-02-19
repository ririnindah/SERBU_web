<?php

namespace App\Http\Controllers;

use App\Models\RedeemKoin; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RedeemKoinController extends Controller
{
    public function index()
    {
        $outletId = session('user.outlet_id');
        $brand = session('user.brand');

        $koin = DB::table('serbu_web.whitelisted_koins')
                ->where('outlet_id', $outletId)
                ->where('brand', $brand) 
                ->value('koin') ?? 0;

        $msisdn = DB::table('serbu_web.whitelisted_koins')
                ->where('outlet_id', $outletId)
                ->where('brand', $brand) 
                ->value(column: 'msisdn') ?? 0;

        return view('redeem_koin', compact('koin', 'msisdn'));
    }

    public function redeem(Request $request)
    {
        $outletId = session('user.outlet_id');
        $brand = session('user.brand');

        $koin = DB::table('serbu_web.whitelisted_koins')
                ->where('outlet_id', $outletId)
                ->where('brand', $brand) 
                ->value('koin') ?? 0;

        $msisdn = DB::table('serbu_web.whitelisted_koins')
            ->where('outlet_id', $outletId)
            ->where('brand', $brand) 
            ->value(column: 'msisdn') ?? 0;

        $request->validate([
    'msisdn' => [
        'required',
        'numeric',
        'starts_with:08',
        'digits_between:10,13',
        function ($attribute, $value, $fail) use ($msisdn) {
            if ($value != $msisdn) {
                $fail('MSISDN harus sama dengan nomor terdaftar.');
            }
        },
    ],
    'jumlah_koin' => [
        'required',
        'integer',
        'min:500',
        function ($attribute, $value, $fail) use ($koin) {
            if ($value >= $koin) {
                $fail('KOIN yang di redeem harus lebih kecil dari jumlah KOIN sekarang');
            }
        },
    ],
        ], [
            'msisdn.starts_with' => 'Nomor HP harus diawali dengan 08.',
            'msisdn.digits_between' => 'Nomor HP harus berjumlah 10 sampai 13 digit.',
            'jumlah_koin.min' => 'Maaf, minimal koin yang bisa di-redeem adalah 500.',
        ]);

        RedeemKoin::create([
            'outlet_id'   => $outletId,
            'brand'       => $brand,
            'msisdn'      => $request->msisdn,        
            'redeem_koin' => $request->jumlah_koin
        ]);

        return redirect()->to('/serbu')->with('success', 'Redeem koin berhasil diproses!');
    }
}
