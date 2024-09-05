<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Satpam
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        
        if (Auth::check() && Auth::user()->role == 'Satpam') {
            return $next($request);
        }
    
        // Auth::logout();
        auth()->guard('web')->logout();
        return redirect()->route('login')->with('forbidden','You are not authorized to access this page.');
        
    }

}
