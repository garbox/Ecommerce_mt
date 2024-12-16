<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class Production
{
    public function handle(Request $request, Closure $next): Response
    {   
        if (is_null(Auth::user())){
            return redirect('/login');
        }
        else {
            if (Auth::user()->role_id == 1 || Auth::user()->role_id() == 3) {
                return $next($request);
            }
            return redirect('/user/login');
        }      
    }
}
