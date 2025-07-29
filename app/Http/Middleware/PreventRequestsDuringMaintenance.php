<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PreventRequestsDuringMaintenance
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (File::exists(storage_path('framework/maintenance.php'))) {
            abort(503); // Menampilkan halaman pemeliharaan
        }

        return $next($request);
    }
}
