<?php

namespace App\Http\Controllers\api\admins\Auth;

use App\Models\admin\user_admin;
use \Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use  Tymon\JWTAuth\Facades\JWTAuth;
use Symfony\Component\HttpFoundation\File\getClientOriginalExtension;

use Auth;
class RegisterController extends Controller
{
    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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

    // public function __construct()//JWTAuth $auth)
    // {
    //   //  $this->auth= $auth;
    //      $this->middleware('guest');
    //      $this->middleware('guest:user_admins');
    // }

      protected function guard()
    {
        return Auth::guard('admins');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255','unique:user_admins'],
            'password' => ['required', 'string', 'min:8'],
        ]);
    }



    /*
      * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator=$this->validator($request->all());

       if(!$validator->fails())
       {
           $user= $this->create($request->all());


           $token= Auth::guard('admins')->attempt($request->only('email','password'));



           return response()->json
           ([
               'success' =>  true,
               'data' => $user,
               'token' => $token
           ],200);
       }
       return response()->json([

           'success' =>false,
           'errors' => $validator->errors()

       ]);
    }


    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\admin\user_admin
     */
    protected function create(array $data)
    {
        return user_admin::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),



        ]);
    }
}


