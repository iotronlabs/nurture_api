<?php

namespace App\Http\Middleware;

use Closure;

use Auth;

class AuthenticateAllUsers
{
    
    public function handle($request, Closure $next)
    {

        if ((! Auth::guard('user_teachers')->check()) || (! Auth::guard('students')->check()) || (! Auth::guard('user_staffs')->check()) || (! Auth::guard('user_admins')->check())) {
           return redirect('/');
       }

        return $next($request);
    }
}
