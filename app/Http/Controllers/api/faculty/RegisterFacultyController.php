<?php

namespace App\Http\Controllers\api\faculty;

use App\Http\Controllers\Controller;
use App\Models\faculty\user_faculty;
use Auth;
use Config;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class RegisterFacultyController extends Controller
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

    public function __construct()
    {

        $this->middleware('authfacultyheadsubadmin');

    }


      protected function guard()
     {
       return Auth::guard('faculties');
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
            'faculty_fname' => ['required', 'string', 'max:255'],
            'faculty_email' => ['required', 'string', 'email', 'max:255','unique:user_faculties'],
            'password' => ['required', 'string', 'min:5'],
            'faculty_gender' => ['required', 'max:1'],
            'faculty_contact' => ['required', 'min:10'],
            'faculty_dob' => ['required'],
            'faculty_centre' => ['required'],

        ]);
    }

    public function register(Request $request)
    {
	        $validator=$this->validator($request->all());

	       if(!$validator->fails())
	       {
	           $user= $this->create($request->all());

             // $token= Auth::guard('faculties')->attempt($request->only('faculty_email','password'));

	           return response()->json
	           ([


	               'success' =>  true,
	               'data' => $user,

	               // 'token' => $token,

	           ],200);
	       }
	       return response()->json([

	           'success' =>false,
	           'errors' => $validator->errors()

	       ]);
    }



    protected function create(array $data)
    {
        
           return user_faculty::create([

            'faculty_fname' => $data['faculty_fname'],
            'faculty_surname' => $data['faculty_surname'],
            'faculty_email' => $data['faculty_email'],
            'password' => Hash::make($data['password']),
            'faculty_gender' => $data['faculty_gender'],
            'faculty_contact' => $data['faculty_contact'],
            'faculty_dob' => $data['faculty_dob'],
          
            'faculty_address' => $data['faculty_address'],
          
            'faculty_address_pin' => $data['faculty_address_pin'],
            'faculty_address_state' => $data['faculty_address_state'],
            'faculty_address_city' => $data['faculty_address_city'],
            'faculty_sub' => $data['faculty_sub'],
            'faculty_centre' => $data['faculty_centre'],


 
        ]);
      }
}
