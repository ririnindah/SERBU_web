<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'outlet_id' => 'required'
        ]);

        $user = DB::table('serbu_users')
            ->where('outlet_id', $request->outlet_id)
            ->first();

        // Kalau outlet belum terdaftar
        if (!$user) {
            return back()->with('error', 'Outlet ID tidak terdaftar');
        }

        // HIT + 1 (LOGIN DARI DEVICE BARU)
        DB::table('serbu_users')
            ->where('id', $user->id)
            ->increment('hit');

        // SIMPAN SESSION
        Session::put('user', [
            'id' => $user->id,
            'outlet_id' => $user->outlet_id,
            'outlet_name' => $user->outlet_name,
            'brand' => $user->brand
        ]);

        return redirect('/serbu');
    }

    public function logout()
    {
        Session::flush();
        return redirect('/login');
    }
}
