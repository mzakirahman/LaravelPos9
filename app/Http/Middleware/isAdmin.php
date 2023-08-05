<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class isAdmin
{
    public function handle(Request $request, Closure $next)
    {
        // Cek apakah pengguna sudah terotentikasi
        if (auth()->check()) {
            // Dapatkan level pengguna
            $userLevel = auth()->user()->level; // Gantilah 'level' sesuai dengan atribut level di model User Anda

            // Periksa apakah level pengguna adalah admin (misalnya, level 1 adalah admin)
            if ($userLevel === 1) {
                // Jika level adalah admin, lanjutkan ke rute yang diminta
                return $next($request);
            }
        }

        // Jika bukan admin, alihkan ke halaman lain atau berikan pesan kesalahan
        return redirect()->route('home')->with('error', 'Anda tidak memiliki izin untuk mengakses halaman ini.');

    }
}
