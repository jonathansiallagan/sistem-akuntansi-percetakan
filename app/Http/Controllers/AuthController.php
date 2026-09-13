<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // === FITUR LOGIN ===

    // 1. Menampilkan halaman form login
    public function login()
    {
        return view('auth.login'); 
    }

    // 2. Memproses data login
    public function authenticate(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Coba mencocokkan email dan password ke database
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Mengarahkan ke halaman Admin atau Kasir
            return redirect()->intended('/admin')->with('success', 'Berhasil login!');
        }

        // Jika email/password salah, kembalikan ke halaman login dengan pesan error
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    // === FITUR REGISTER (Yang sebelumnya dibuat) ===
    
    public function register()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        return redirect('/admin')->with('success', 'Akun pengguna baru berhasil ditambahkan!');
    }
}