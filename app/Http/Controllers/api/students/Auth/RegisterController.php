<?php

namespace App\Http\Controllers\api\students\Auth;

use App\Models\student\user_student;
use \Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use  Tymon\JWTAuth\Facades\JWTAuth;
use Config;
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

    public function __construct()
    {

       $this->middleware('guest:students');
       $this->middleware('guest');

      // $this->auth= $auth;

    }


      protected function guard()
    {
        return Auth::guard('students');
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
            's_fname' => ['required', 'string', 'max:255'],
            's_email' => ['required', 'string', 'email', 'max:255','unique:user_students'],
            'password' => ['required', 'string', 'min:5'],
            's_gender' => ['required', 'max:1'],
            's_contact' => ['required', 'min:10'],
            's_dob' => ['required'],


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

           // Config::set('jwt.user', 'App\Models\student\user_student');
           // Config::set('auth.providers.users.model', \App\Models\student\user_student::class);

           $token= Auth::guard('students')->attempt($request->only('s_email','password'));



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



      $request = request();

              // $profileImage = $request->file('s_profile_picture');
              // $profileImageSaveAsName = time() . Auth::id() . "-profile." .
              //                           $profileImage->getClientOriginalExtension();

              // $upload_path = 'profile_images/student/';
              // $profile_image_url = $upload_path . $profileImageSaveAsName;
              // $success = $profileImage->move($upload_path, $profileImageSaveAsName);



        return user_student::create([
            's_fname' => $data['s_fname'],
            's_mname' => $data['s_mname'],
            's_surname' => $data['s_surname'],
            's_email' => $data['s_email'],
            'password' => Hash::make($data['password']),
            's_gender' => $data['s_gender'],
            's_contact' => $data['s_contact'],
            's_dob' => $data['s_dob'],
            's_age' => $data['s_age'],
            's_nationality' => $data['s_nationality'],
            's_address' => $data['s_address'],
            's_religion' => $data['s_religion'],
            's_address_pin' => $data['s_address_pin'],
            's_address_state' => $data['s_address_state'],
            'guardian_fname' => $data['guardian_fname'],
            'guardian_mname' => $data['guardian_mname'],
            'guardian_surname' => $data['guardian_surname'],
            'guardian_email' => $data['guardian_email'],
            'guardian_contact' => $data['guardian_contact'],
            'guardian_address' => $data['guardian_address'],
            'guardian_city' => $data['guardian_city'],
            'guardian_pin' => $data['guardian_pin'],
            'guardian_state' => $data['guardian_state'],
            'class_id' => $data['class_id'],
            's_address_city' => $data['s_address_city'],

            // 's_profile_picture' => $profile_image_url,




        ]);
    }
}


