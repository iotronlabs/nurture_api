<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class AuthLoginController extends Controller
{
    public function loginRoute(Request $request)
    {

        $user['password'] = $request->password;


       	// return $request->authentication;
         if($request->authentication =='student')
       	   {
             $user['s_email'] = $request->email;

       		  return redirect()->action('api\students\Auth\LoginController@login',$user);

       	   	   // reditect::route('/api/students/login','api\students\Auth\LoginController@login');
           }

         if($request->authentication =='faculty')
           {
             $user['faculty_email'] = $request->email;

            return redirect()->action('api\faculty\FacultyLoginController@login',$user);

               // reditect::route('/api/students/login','api\students\Auth\LoginController@login');
           }

           if($request->authentication =='admin')
           {
             $user['email'] = $request->email;

            return redirect()->action('api\admins\Auth\LoginController@login',$user);

               // reditect::route('/api/students/login','api\students\Auth\LoginController@login');
           }


           if($request->authentication =='facultyhead')
           {
             $user['faculty_head_email'] = $request->email;

            return redirect()->action('api\facultyheads\FacultyHeadLoginController@login',$user);

               // reditect::route('/api/students/login','api\students\Auth\LoginController@login');
           }

           if($request->authentication =='subadmin')
           {
             $user['sub_admin_email'] = $request->email;

            return redirect()->action('api\sub_admins\SubAdminLoginController@login',$user);

               // reditect::route('/api/students/login','api\students\Auth\LoginController@login');
           }
   }


    public function check_user(Request $request)
    {
           if(Auth::guard('students')->check())
           {

            return redirect()->action('api\students\StudentController@usercheck');

           }

         if(Auth::guard('admins')->check())
           {

            return redirect()->action('api\admins\AdminController@usercheck');

           }
            if(Auth::guard('faculties')->check())
           {

            return redirect()->action('api\faculty\FacultyController@usercheck');

           }
             if(Auth::guard('faculty_heads')->check())
           {

            return redirect()->action('api\facultyheads\FacultyHeadController@usercheck');

           }
           if(Auth::guard('sub_admins')->check())
           {

            return redirect()->action('api\facultyheads\SubAdminController@usercheck');

           }



    }
}
