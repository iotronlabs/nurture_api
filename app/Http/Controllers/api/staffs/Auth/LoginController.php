<?php

namespace App\Http\Controllers\api\staffs\Auth;

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
    public function __construct()
    {
        $this->middleware('guest');
         $this->middleware('guest:user_staffs');
    }

      protected function guard()
    {
        return Auth::guard('user_staffs');
    }


public function login(Request $request)
    {




       // $this->incrementLoginAttempts($request);
       // if ($this->attemptLogin($request)) {
       //     return $this->sendLoginResponse($request);
       //  }

       //  If the login attempt was unsuccessful we will increment the number of attempts
       //  to login and redirect the user back to the login form. Of course, when this
       //  user surpasses their maximum number of attempts they will get locked out.


       //          return $this->sendFailedLoginResponse($request);
       try{
            if(!$token= Auth::guard('user_staffs')->attempt($request->only('st_email','password')) )
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