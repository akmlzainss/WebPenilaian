<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ValidatePostSize
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
        // Contoh validasi ukuran post (dalam bytes)
        if ($request->getContentLength() > 5000000) { // Maksimal 5MB
            abort(413, 'Request Entity Too Large');
        }

        return $next($request);
    }
}
