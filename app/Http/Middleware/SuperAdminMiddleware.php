<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class SuperAdminMiddleware
{
    public function handle($request, Closure $next)
    {
        if (!Auth::check() || !Auth::user()->hasRole('super-admin')) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}
