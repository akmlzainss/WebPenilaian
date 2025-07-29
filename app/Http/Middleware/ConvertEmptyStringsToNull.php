<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ConvertEmptyStringsToNull
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
        $request->merge(array_map(function ($value) {
            return $value === '' ? null : $value;
        }, $request->all()));

        return $next($request);
    }
}
