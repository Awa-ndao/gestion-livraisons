<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::guard('admin')->check()) {
            return redirect('/login');
        }

        if (Auth::guard('admin')->user()->role !== 'admin') {
            return redirect('/')->with('error', 'Accès refusé — Zone réservée à l\'administrateur.');
        }

        return $next($request);
    }
}