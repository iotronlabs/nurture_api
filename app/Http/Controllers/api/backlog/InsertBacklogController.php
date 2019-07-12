<?php

namespace App\Http\Controllers\api\backlog;

use App\Models\backlog\table_backlog;
use \Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use  Tymon\JWTAuth\Facades\JWTAuth;
use Auth;

class InsertBacklogController extends Controller
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

    // public function __construct()
    // { 
    //   $this->middleware('guest');
    //      $this->middleware('guest:user_staffs');
    //    // $this->auth= $auth;
    // }


    //   protected function guard()
    // {
    //     return Auth::guard('user_staffs');
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
            'student_id' => ['required', 'integer'],
            'class_id' => ['required'],
            'sub_id' => ['required'],
            'sub_name' => ['required', 'min:1'],
           
        ]);
    }

    
  
    public function register(Request $request)
    {
        $validator=$this->validator($request->all());
        
       if(!$validator->fails())
       {
           $user= $this->create($request->all());
           return response()->json
           ([
               'success' =>  true,
               'data' => $user,

           ],200);
       }
       return response()->json([
           
           'success' =>false,
           'errors' => $validator->errors()
           
       ]);
    }

    
   
    protected function create(array $data)
    {
      
        return table_backlog::create([
            'student_id' => $data['student_id'],
            'class_id' => $data['class_id'],
            
            'sub_id' => $data['sub_id'],
            'sub_name' => $data['sub_name'],
           

        ]);
    }
}
