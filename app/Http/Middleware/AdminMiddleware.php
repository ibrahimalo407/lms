<?php

// Dans AdminMiddleware.php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        if (!Auth::check() || (!Auth::user()->isAdmin() && !Auth::user()->isTeacher())) {
            return redirect('/');
        }

        return $next($request);
    }
}
