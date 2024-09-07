<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        if (!auth()->user()->isAdmin()) {
            return redirect('/'); // ou une autre route accessible aux utilisateurs normaux
        }

        return $next($request);
    }
}
