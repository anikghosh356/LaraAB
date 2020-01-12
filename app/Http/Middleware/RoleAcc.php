<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class RoleAcc
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {   
        if (Auth::check() && Auth::user()->role == 'admin') 
        {
            return $next($request);
        }elseif (!Auth::check()) {
            return redirect('/login');
        }
        return redirect('/');
        
    }
}
