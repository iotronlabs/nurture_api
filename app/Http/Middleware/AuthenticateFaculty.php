<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class AuthenticateFaculty

{
     public function handle($request, Closure $next)
    {   
        if(!Auth::guard('faculties')->check())
        {
            return redirect('/');
        }
        return $next($request);
    }
}
