<?php

namespace App\Http\Middleware;

use Closure;

use Auth;

class AuthenticateStudent
{
   
    public function handle($request, Closure $next)
    {   
        if(!Auth::guard('students')->check())
        {
            return redirect('/');
        }
        return $next($request);
    }
}


?>