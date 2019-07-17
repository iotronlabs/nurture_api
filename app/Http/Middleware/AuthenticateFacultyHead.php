<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class AuthenticateFacultyHead
{
    
    public function handle($request, Closure $next)
    {
        if(!Auth::guard('faculty_heads')->check())
        {
            return redirect('/');
        }
        return $next($request);
    }
}
