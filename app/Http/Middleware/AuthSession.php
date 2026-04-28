<?php

namespace App\Http\Middleware;

use Closure;

class AuthSession
{
    public function handle($request, Closure $next)
    {
        if (!session('user_id')) {
            return redirect('/login');
        }

        auth()->guard()->loginUsingId(session('user_id'));

        return $next($request);
    }
}