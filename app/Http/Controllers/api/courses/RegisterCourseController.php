<?php

namespace App\Http\Controllers\api\courses;

use  Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use App\Models\course\subject_course;
use App\Models\course\table_course;
use Auth;
use Config;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use \Illuminate\Http\Request;

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



         table_course::create([

          'course_name' => $data['course_name'],

          'course_duration' => $data['course_duration'],


        ]);

        foreach ($data['subject'] as $subject) {

         subject_course::create([

            'course_name' => $data['course_name'],

            'sub_name' => $subject,

         ]);
        }

        // return response()->json([

        //     'success' => true,
        // ],200);

    }
}




