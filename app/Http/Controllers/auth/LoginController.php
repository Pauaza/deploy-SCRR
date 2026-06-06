<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|',
        ], [
            'username.required' => 'Username wajib diisi',
            'password.required' => 'Password wajib diisi',
        ]);

        // Coba login ke tabel mahasiswa dulu
        if (Auth::guard('mahasiswa')->attempt([
            'username' => $request->username,
            'password' => $request->password,
        ], $request->boolean('remember'))) {

            $request->session()->regenerate();
            return redirect()->route('mahasiswa.dashboard');
        }

        // Jika gagal, coba login sebagai admin
        if (Auth::guard('admin')->attempt([
            'username' => $request->username,
            'password' => $request->password,
        ], $request->boolean('remember'))) {

            $request->session()->regenerate();
            return redirect()->route('admin.dashboard');
        }

        // Jika keduanya gagal
        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ])->onlyInput('username');
    }

    public function logout(Request $request)
    {
        Auth::guard('mahasiswa')->logout();
        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
