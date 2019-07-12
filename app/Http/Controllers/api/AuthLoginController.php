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

         if($request->authentication =='teacher')
           {
             $user['t_email'] = $request->email;

            return redirect()->action('api\teachers\Auth\LoginController@login',$user);

               // reditect::route('/api/students/login','api\students\Auth\LoginController@login');
           }

           if($request->authentication =='staff')
           {
             $user['st_email'] = $request->email;

            return redirect()->action('api\staffs\Auth\LoginController@login',$user);

               // reditect::route('/api/students/login','api\students\Auth\LoginController@login');
           }
   } 


    public function check_user(Request $request)
    {
           if(Auth::guard('students')->check())
           {  

            return redirect()->action('api\students\StudentController@usercheck');

           }

         if(Auth::guard('user_teachers')->check())
           {  

            return redirect()->action('api\teachers\TeacherController@usercheck');

           }
            if(Auth::guard('user_staffs')->check())
           {  

            return redirect()->action('api\staffs\StaffController@usercheck');

           }


         
    }
}
