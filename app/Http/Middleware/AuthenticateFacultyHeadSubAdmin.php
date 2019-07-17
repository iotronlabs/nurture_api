<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class AuthenticateFacultyHeadSubAdmin
{
   
    public function handle($request, Closure $next)
    {
         if(Auth::guard('faculty_heads')->check() || Auth::guard('sub_admins')->check())
        {
             return $next($request);
        }
        else
        {
              return redirect('/');
        }
    }
}
