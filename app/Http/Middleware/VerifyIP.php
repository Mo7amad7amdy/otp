<?php

namespace App\Http\Middleware;

use App\BlockIp;
use Closure;

class VerifyIP
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
        $blockedIPs = BlockIp::where('ip', $request->ip())->first();
        if (isset($blockedIPs) && $blockedIPs->times > 6){
            abort('503', 'This IP is Blocked');
        }
        return $next($request);
    }
}
