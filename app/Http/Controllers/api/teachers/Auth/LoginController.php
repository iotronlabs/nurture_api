<?php

namespace App\Http\Controllers\api\teachers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use  Tymon\JWTAuth\Facades\JWTAuth;
use Auth;
class LoginController extends Controller
{
     use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '';
    protected $auth;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()//JWTAuth $auth)
    {
       // $this->auth = $auth;
          $this->middleware('guest');
          $this->middleware('guest:user_teachers');
    }

       protected function guard()
    {
        return Auth::guard('teachers');
    }



public function login(Request $request)
    {



        //$this->incrementLoginAttempts($request);
       
        try{
            if(!$token= Auth::guard('user_teachers')->attempt($request->only('t_email','password')) )
                    {
                        return response()->json
                            ([
                                'success' =>false,
                                'message' => "Invalid Email Address or Password Please try again",
                                'errors' => [
                                    "Invalid Email Address or Password "
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
            //    'data' => $request->all(),
               'token' =>$token
               ],200);

    }
}
