<?php

namespace App\Http\Middleware;

use Closure;

class CheckToken
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

        if($request ->input('token') != 'admin'){
//            return redirect()->to('http://www.baidu.com');
             dd('need token!');
        }
        return $next($request);
    }
}
