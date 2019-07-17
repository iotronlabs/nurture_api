<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class AuthenticateAdminSubAdmin
{
    
    public function handle($request, Closure $next)
    {
        if(Auth::guard('admins')->check() || Auth::guard('sub_admins')->check())
        {
             return $next($request);
        }
        else
        {
              return redirect('/');
        }

       
    }
}
