<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class CheckVendor
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
        if (Auth::user()->is_vendor()) {
            return $next($request);
        }
        return redirect('customer/my-account');
    }
}
