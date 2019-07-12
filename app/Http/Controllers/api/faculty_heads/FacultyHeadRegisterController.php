<?php

namespace App\Http\Controllers\api\faculty_heads;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Tymon\JWTAuth\Facades\JWTAuth;
use Config;
use Auth;

class FacultyHeadRegisterController extends Controller
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

      //  $this->middleware('guest:students');
      //  $this->middleware('guest');

      // // $this->auth= $auth;

    }


    //   protected function guard()
    // {
    //     return Auth::guard('students');
    // }


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'faculty_head_fname' => ['required', 'string', 'max:255'],
            'faculty_head_email' => ['required', 'string', 'email', 'max:255','unique:user_students'],
            'password' => ['required', 'string', 'min:5'],
            'faculty_head_gender' => ['required', 'max:1'],
            'faculty_head_contact' => ['required', 'min:10'],
            'faculty_head_dob' => ['required'],


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

           // $token= Auth::guard('students')->attempt($request->only('faculty_head_email','password'));



           return response()->json
           ([
               'success' =>  true,
               'data' => $user,
               // 'token' => $token
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

              // $profileImage = $request->file('faculty_head_profile_picture');
              // $profileImageSaveAsName = time() . Auth::id() . "-profile." .
              //                           $profileImage->getClientOriginalExtension();

              // $upload_path = 'profile_images/student/';
              // $profile_image_url = $upload_path . $profileImageSaveAsName;
              // $success = $profileImage->move($upload_path, $profileImageSaveAsName);



        return user_student::create([
            'faculty_head_fname' => $data['faculty_head_fname'],
            'faculty_head_surname' => $data['faculty_head_surname'],
            'faculty_head_email' => $data['faculty_head_email'],
            'password' => Hash::make($data['password']),
            'faculty_head_gender' => $data['faculty_head_gender'],
            'faculty_head_contact' => $data['faculty_head_contact'],
            'faculty_head_dob' => $data['faculty_head_dob'],
          
            'faculty_head_address' => $data['faculty_head_address'],
          
            'faculty_head_address_pin' => $data['faculty_head_address_pin'],
            'faculty_head_address_state' => $data['faculty_head_address_state'],

            'faculty_head_address_city' => $data['faculty_head_address_city'],


            // 'faculty_head_profile_picture' => $profile_image_url,




        ]);
    }
}



}
}
