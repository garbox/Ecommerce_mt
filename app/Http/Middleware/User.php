<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class User
{
    public function handle(Request $request, Closure $next): Response
    {   
        if (is_null(Auth::user())){
            return redirect('/login')->with('status', 'Please log in or create an account before you continue.');
        }
        else {
            if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2 || Auth::user()->role_id == 3 ) {
                return $next($request);
            }
                return redirect('/');
        }
    }
}
