<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        
        if (Auth::check() && Auth::user()->is_admin == 1) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login'); 
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {

            if (Auth::user()->is_admin == 1) {
                $request->session()->regenerate();
                return redirect()->intended(route('admin.dashboard'));
            } else {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'Akun ini tidak memiliki hak akses admin.',
                ]);
            }
        }

        return back()->withErrors([
            'email' => 'Email atau Password yang Anda masukkan salah.',
        ]);
    }
}