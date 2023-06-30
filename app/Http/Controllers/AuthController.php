<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function proseslogin(Request $request)
    {
        // $pas = "admin123";
        // echo Hash::make($pas);
        if (Auth::guard('pegawai')->attempt(['NPP' => $request->npp, 'password' => $request->password])) {
            return redirect('/dashboard');
        } else {
            return redirect('/')->with(['warning' => 'NPP / Password Salah']);
        }
    }
    public function proseslogout()
    {
        if (Auth::guard('pegawai')->check()) {
            Auth::guard('pegawai')->logout();
            return redirect('/');
        }
    }
}
