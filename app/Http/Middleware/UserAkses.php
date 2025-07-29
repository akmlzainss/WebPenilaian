<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UserAkses
{
    public function handle(Request $request, Closure $next, $role)
    {
        // Cek apakah user sudah login
        if (!Auth::check()) {
            Log::warning('Percobaan akses tanpa login', [
                'ip' => $request->ip(),
                'url' => $request->fullUrl()
            ]);
            return redirect('/')->withErrors(['login' => 'Silakan login terlebih dahulu']);
        }

        $user = Auth::user();
        
        // Cek apakah role user sesuai
        if (strtolower($user->role) !== strtolower($role)) {
            Log::warning('Percobaan akses tidak sah', [
                'user_id' => $user->id,
                'role_dibutuhkan' => $role,
                'role_user' => $user->role
            ]);
            return redirect('/')->withErrors(['role' => 'Anda tidak memiliki akses ke halaman ini']);
        }

        return $next($request);
    }
}