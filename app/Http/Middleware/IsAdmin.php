<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        // Cek 1: Apakah sudah login?
        // Cek 2: Apakah dia Admin? (is_admin == 1)
        if (Auth::check() && Auth::user()->is_admin) {
            return $next($request); // Silakan masuk, Paduka!
        }

        // Kalau bukan admin, tendang ke Home atau tampilkan error
        return redirect('/')->with('error', 'Anda tidak memiliki akses ke halaman Admin!');
    }
}