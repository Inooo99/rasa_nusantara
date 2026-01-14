<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    // 1. Tampilkan Form Daftar
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // 2. Proses Simpan User Baru
    public function register(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users', // Email harus unik
            'password' => 'required|string|min:8|confirmed', // Password harus sama dengan konfirmasi
        ]);

        // Buat User Baru
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Langsung Login otomatis setelah daftar
        Auth::login($user);

        // Redirect ke Home dengan pesan sukses
        return redirect()->route('home')->with('success', 'Selamat datang! Akun Anda berhasil dibuat.');
    }
}