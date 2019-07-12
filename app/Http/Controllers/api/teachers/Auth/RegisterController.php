<?php

namespace App\Http\Controllers\api\teachers\Auth;

use App\Models\teacher\user_teacher;
use \Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use  Tymon\JWTAuth\Facades\JWTAuth;
use Auth;
use Config;
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

    public function __construct()//JWTAuth $auth)
    {
       // $this->auth= $auth;
         $this->middleware('guest');
          $this->middleware('guest:user_teachers');
    }


    protected function guard()
    {
        return Auth::guard('teachers');
    }

    
  //   return redirect('/user_teacher/register');

  // }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            't_fname' => ['required', 'string', 'max:255'],
            't_email' => ['required', 'string', 'email', 'max:255','unique:user_teachers'],
            'password' => ['required', 'string', 'min:8'],
            't_gender' => ['required', 'max:1'],
            't_contact' => ['required', 'min:10'],
           // 't_profile_picture' => ['mimes:jpeg,jpg,png,gif|required|max:10000'],
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
           
           
           $token= Auth::guard('user_teachers')->attempt($request->only('t_email','password'));
           
           
           
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

            //  $request = request();

            // $profileImage = $request->file('t_profile_picture');
            // $profileImageSaveAsName = time() . Auth::id() . "-profile." . 
            //                           $profileImage->getClientOriginalExtension();

            // $upload_path = 'profile_images/teacher/';
            // $profile_image_url = $upload_path . $profileImageSaveAsName;
            // $success = $profileImage->move($upload_path, $profileImageSaveAsName);


        return user_teacher::create([
            't_fname' => $data['t_fname'],
            
            'password' => Hash::make($data['password']),
            't_gender' => $data['t_gender'],
            't_contact' => $data['t_contact'],
            //'t_id' => $data['t_id'],
            //'t_ref_id' => $data['t_ref_id'],
            //'status' => $data['status'],
            't_mname' => $data['t_mname'],
            't_surname' => $data['t_surname'],
            't_dob' => $data['t_dob'],
            't_age' => $data['t_age'],
            't_email' =>  $data['t_email'],
            't_nationality' => $data['t_nationality'],
            't_religion'  => $data['t_religion'],
            't_address'  => $data['t_address'],
            't_address_pin' => $data['t_address_pin'],
            't_address_state' => $data['t_address_state'],
            't_sub' => $data['t_sub'],
            't_address_city' => $data['t_address_city'],
            //'t_status' => $data['t_status'],
            //'t_authentication'  => $data['t_authentication'],
            //'t_profile_picture' => $profile_image_url,

        ]);
    }
}


