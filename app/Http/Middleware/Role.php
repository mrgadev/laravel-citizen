<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        if (! $request->user()->hasRole($role)) {
            // return response()->json(['message' => 'tidak bisa mengakses, karena anda bukan bagian role '.$role]);
            Auth::guard('web')->logout();
            return redirect()->route('login')->with('status','You are not authorized to access this page.');
         }
 
         return $next($request);
        // foreach ($roles as $role) {
        // }
    }
}
