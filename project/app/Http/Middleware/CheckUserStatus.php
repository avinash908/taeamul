<?php

namespace App\Http\Middleware;

use Closure;

class CheckUserStatus
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
        if (auth()->check() && auth()->user()->status != 1) {
            auth()->logout();
            return redirect()->route('login')->with('msg','Your Account has been blocked! Please Contact Administrator');
        }
        return $next($request);
    }
}
