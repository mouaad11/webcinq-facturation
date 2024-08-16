<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role === 'client') {
            return $next($request);
        }

        return redirect('/')->with('error', 'Vous n\'êtes pas autorisé à accéder à cette page.');
    }
}