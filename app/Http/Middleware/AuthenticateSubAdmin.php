<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class AuthenticateSubAdmin
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
        if(!Auth::guard('sub_admins')->check())
        {
            return redirect('/');
        }
        return $next($request);
    }
}
