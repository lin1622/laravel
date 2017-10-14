<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
//        return $next($request);
        if (! $request->user()->hasRole($role)) {
            // Redirect...
            dd('aaa');
        }

        return $next($request);
    }
}
