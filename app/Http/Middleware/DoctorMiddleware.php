<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DoctorMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check() || (int) Auth::user()->usertype !== 2) {
            return redirect('/home');
        }

        return $next($request);
    }
}
