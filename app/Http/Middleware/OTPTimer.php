<?php

namespace App\Http\Middleware;

use Closure;

class OTPTimer
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
        if (auth()->user()->verify_code_time > now()){
            return back();
        }
        return $next($request);
    }
}
