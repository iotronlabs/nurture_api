<?php

namespace App\Http\Controllers\api\sub_admins;

use  Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use App\Models\sub_admin\user_sub_admin;
use Auth;
use Config;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class SubAdminRegisterController extends Controller
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
         $this->middleware('authadmin');

      // // $this->auth= $auth;

    }


      protected function guard()
    {
        return Auth::guard('sub_admins');
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
            'sub_admin_fname' => ['required', 'string', 'max:255'],
            'sub_admin_email' => ['required', 'string', 'email', 'max:255','unique:user_sub_admins'],
            'password' => ['required', 'string', 'min:8'],
            'sub_admin_gender' => ['required', 'max:1'],
            'sub_admin_contact' => ['required', 'min:10'],
            'sub_admin_dob' => ['required'],
            'sub_admin_address_pin' => ['required'],
            'sub_admin_address' => ['required'],
            'sub_admin_address_city' => ['required'],
            'sub_admin_address_state' => ['required'],
            'sub_admin_centre_address_state' => ['required'],
            'sub_admin_centre_name' => ['required'],
            'sub_admin_centre_id' => ['required'],
            'sub_admin_centre_address' => ['required'],
            'sub_admin_centre_address_city' => ['required'],
            'sub_admin_centre_address_pin' => ['required'],


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

           // $token= Auth::guard('students')->attempt($request->only('sub_admin_email','password'));



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
        // $Image = $data['image'];
        $Image = $request->file('sub_admin_profile_picture');
        $ImageSaveAsName = time() . Auth::id() . "-profile." .
                                $Image->getClientOriginalExtension();

        $upload_path = 'profile_images/subadmin';
        $image_url =  $ImageSaveAsName;

        $data1 =  user_sub_admin::create([
        'sub_admin_fname' => $data['sub_admin_fname'],
        'sub_admin_surname' => $data['sub_admin_surname'],
        'sub_admin_email' => $data['sub_admin_email'],
        'password' => Hash::make($data['password']),
        'sub_admin_gender' => $data['sub_admin_gender'],
        'sub_admin_contact' => $data['sub_admin_contact'],
        'sub_admin_dob' => $data['sub_admin_dob'],

        'sub_admin_address' => $data['sub_admin_address'],

        'sub_admin_address_pin' => $data['sub_admin_address_pin'],
        'sub_admin_address_state' => $data['sub_admin_address_state'],

        'sub_admin_centre_name' => $data['sub_admin_centre_name'],

        'sub_admin_centre_address' => $data['sub_admin_centre_address'],

        'sub_admin_centre_address_city' => $data['sub_admin_centre_address_city'],

        'sub_admin_centre_address_state' => $data['sub_admin_centre_address_state'],

        'sub_admin_centre_address_pin' => $data['sub_admin_centre_address_pin'],

        'sub_admin_centre_id' => $data['sub_admin_centre_id'],


        'sub_admin_address_city' => $data['sub_admin_address_city'],



        'sub_admin_profile_picture' => $image_url,




        ]);
        $success = $Image->move($upload_path, $ImageSaveAsName);
        return $data1;
    }
}




