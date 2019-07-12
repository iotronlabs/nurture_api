<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
         if ($guard == "students" && Auth::guard($guard)->check()) {
                return redirect('/api/students/register');
            }
         if ($guard == "user_admins" && Auth::guard($guard)->check()) {
                return redirect('/api/admins/register');
            }
        if ($guard == "user_teachers" && Auth::guard($guard)->check()) {
                return redirect('/api/teachers/register');
            }
        if ($guard == "user_staffs" && Auth::guard($guard)->check()) {
                return redirect('/api/staffs/register');
            }    


        return $next($request);
    }
}
