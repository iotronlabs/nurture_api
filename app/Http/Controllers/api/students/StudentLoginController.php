<?php

namespace App\Http\Controllers\api\students;

use Illuminate\Http\Request;
use App\Models\admin\user_admin;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use  Tymon\JWTAuth\Facades\JWTAuth;

use Auth;
class StudentLoginController extends Controller
{
     use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '';
    protected $auth;

    
    // public function __construct()//JWTAuth $auth)
    // {
    //     //$this->auth = $auth;
    //      $this->middleware('guest');
    //      $this->middleware('guest:user_admins');
    // }

      protected function guard()
    {
        return Auth::guard('students');
    }


public function login(Request $request)
    {

        try{
            if(!$token= Auth::guard('students')->attempt($request->only('email','password')) )
                    {
                        return response()->json
                            ([
                                'success' =>false,
                                'message' => "Invalid Email Address or Password Please try again",
                                'errors' => [
                                    "Invalid Email Address or Password Please try again"
                                ]
                            ]);
                    }

        }
        catch(JWTException $e){

            return response()->json
            ([
                'success' =>  false,
                'message' => "Invalid Email Address or Password Please try again",
                'errors' => [
                            "Invalid Email Address or password"
                        ]
                    ]);




        }

    return response()->json
           ([
               'success' =>true,
               'data' => $request->all(),
               'token' =>$token
               ],200);

    }
}
