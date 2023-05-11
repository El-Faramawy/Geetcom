<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Doctor
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
//        abort(403);
        if (Auth::guard('doctor')->check()){
            if ($request=='login'){
                return redirect('/');
            }
//            return $request;
            return $next($request);
        }
//        abort(403);
        return redirect('/');
    }
}
