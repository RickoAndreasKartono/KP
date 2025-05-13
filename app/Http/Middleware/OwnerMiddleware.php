<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OwnerMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Mengecek apakah pengguna yang sedang login adalah 'owner'
        if (Auth::check() && Auth::user()->role === 'owner') {
            return $next($request);  // Lanjutkan request jika role adalah 'owner'
        }

        // Jika bukan 'owner', redirect ke halaman login atau halaman lain
        return redirect()->route('login')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
    }
}
