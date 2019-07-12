<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class AuthenticateTeacher
{
     public function handle($request, Closure $next)
    {   
        if(!Auth::guard('user_teachers')->check())
        {
            return redirect('/');
        }
        return $next($request);
    }
}
