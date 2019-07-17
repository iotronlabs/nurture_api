<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class AuthenticateAdmin
{
    
    public function handle($request, Closure $next)
    {
        if(!Auth::guard('admins')->check())
        {
            return redirect('/');
        }
        return $next($request);
    }
}
