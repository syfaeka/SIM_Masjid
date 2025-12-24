<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // 1. Tampilkan Form Login
    public function showLoginForm()
    {
        return view('login');
    }

    // 2. Proses Cek Password
    public function login(Request $request)
    {
        // Cek apakah data cocok dengan database
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();
            return redirect()->intended('/admin'); // Jika cocok, lempar ke dashboard
        }

        // Jika salah
        return back()->with('error', 'Email atau Password salah!');
    }

    // 3. Proses Keluar (Logout)
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}