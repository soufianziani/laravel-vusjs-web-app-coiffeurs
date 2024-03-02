<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class Owner
{
    public function handle(Request $request, Closure $next): Response
    {
        if(!Auth::guard('owner')->check()){
            return redirect()->route('owner.login');
        }
        else{
            return $next($request);
        }
    }
}