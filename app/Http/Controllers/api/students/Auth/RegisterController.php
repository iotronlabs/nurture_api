<?php

namespace App\Http\Controllers\api\students\Auth;

use App\Models\student\user_student;
use \Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use  Tymon\JWTAuth\Facades\JWTAuth;
use Symfony\Component\HttpFoundation\File\getClientOriginalExtension;

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
     // $this->middleware('authadminsubadmin');

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
            'password' => ['required', 'string', 'min:8'],
            's_gender' => ['required', 'max:1'],
            's_contact' => ['required', 'min:10'],
            's_dob' => ['required'],
            's_centre' => ['required'],
            's_address_pin' => ['required'],
            's_address' => ['required'],
            's_address_city' => ['required'],
            's_address_state' => ['required'],
            'guardian_fname' => ['required'],
            'guardian_email' => ['required'],
            'guardian_contact' => ['required'],
            'guardian_address' => ['required'],
            'guardian_city' => ['required'],
            'guardian_pin' => ['required'],
            'guardian_state' => ['required'],
            's_course' => ['required'],
            's_class' => ['required'],



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

           // $token= Auth::guard('students')->attempt($request->only('s_email','password'));



           return response()->json
           ([
               'success' =>  true,
               'data' =>$user,
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
        if($request->file('s_profile_picture')!=null)
        {
            $Image = $request->file('s_profile_picture');
            $ImageSaveAsName = time() . Auth::id() . "-profile." .
                                    $Image->getClientOriginalExtension();

            $upload_path = 'profile_images/students';
            $image_url =  $ImageSaveAsName;
        }
        else
        {
            $image_url=null;
        }

        $data1= user_student::create([
            's_fname' => $data['s_fname'],

            's_surname' => $data['s_surname'],
            's_email' => $data['s_email'],
            'password' => Hash::make($data['password']),
            's_gender' => $data['s_gender'],
            's_contact' => $data['s_contact'],
            's_dob' => $data['s_dob'],
            // 's_age' => $data['s_age'],
            's_address_city' => $data['s_address_city'],
            // 'guardian_state' => $data['guardian_state'],
            // 's_nationality' => $data['s_nationality'],
            's_address' => $data['s_address'],
            // 's_religion' => $data['s_religion'],
            's_address_pin' => $data['s_address_pin'],
            's_address_state' => $data['s_address_state'],
            'guardian_fname' => $data['guardian_fname'],

            'guardian_surname' => $data['guardian_surname'],
            'guardian_email' => $data['guardian_email'],
            'guardian_contact' => $data['guardian_contact'],
            'guardian_address' => $data['guardian_address'],
            'guardian_city' => $data['guardian_city'],
            'guardian_pin' => $data['guardian_pin'],
            //'s_profile_picture' => $data['s_profile_picture'],
            'guardian_state' => $data['guardian_state'],
            's_centre' => $data['s_centre'],
            's_course' => $data['s_course'],
            's_class' => $data['s_class'],
            'fee_structure' => $data['fee_structure'],
            'scholarship' => $data['scholarship'],
            'fee_period' => $data['fee_period'],

            's_profile_picture' => $image_url,




        ]);
        if($request->file('s_profile_picture')!=null)
        {
            $success = $Image->move($upload_path, $ImageSaveAsName);
        }
        return $data1;
    }
    public function edit($s_id)
  {

     $project = user_student::find($s_id);

     return response()->json
           ([
               'success' =>  true,
               'data' => $project,

           ],200);
  }

public function update(Request $request, $s_id)
{



        $task = user_student::findOrFail($s_id);


        $this->validate($request, [
          's_email' => 'required',
          's_gender' => 'required',
          's_fname' =>  'required',
          's_contact'  => 'required',
          's_dob' =>    'required',
          's_address'  => 'required',
          's_address_city' => 'required',
          's_address_state'=> 'required',
          's_address_pin' => 'required',
          'guardian_fname' => 'required',
          'guardian_email' => 'required',
          'guardian_contact' => 'required',
          'guardian_address' => 'required',
          'guardian_state' => 'required',
          'guardian_pin' => 'required',
          'guardian_city' => 'required',
          's_centre' => 'required',
          's_class' => 'required',
          'fee_structure' => 'required',
          'scholarship' => 'required',
          'fee_period' => 'required',
          // 's_profile_picture' => 'required',
          // 'status' => 'required',

               //edit here if required to update content//
        ]);


 // dd($s_id);

        $input = $request->all();

        $task->fill($input)->save();


         return response()->json
               ([
                   'success' =>  true,
                   'data' => $task,

               ],200);


}
}


