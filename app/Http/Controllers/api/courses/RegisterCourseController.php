<?php

namespace App\Http\Controllers\api\courses;

use App\Models\course\table_course;
use \Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use  Tymon\JWTAuth\Facades\JWTAuth;
use Config; 
use Auth;

class RegisterCourseController extends Controller
{
    protected function validator(array $data)
    {
        return Validator::make($data, [
           // 'class_id' => ['required', 'string', 'max:255'],
           
            'course_name' => ['required', 'string', 'min:1'],
           
            'course_duration' => ['required'],

            

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
               'data' => [

               	'course_name'  => $user->course_name,
               	'course_duration' => $user->course_duration,
                
               ]
               //'token' => $token
           ],200);
       }
       return response()->json([
           
           'success' =>false,
           'errors' => $validator->errors()
           
       ]);
    }



    protected function create(array $data)
    { 



        return table_course::create([
           
              'course_name' => $data['course_name'],
           
            'course_duration' => $data['course_duration'],
          
        ]);
    }
}




