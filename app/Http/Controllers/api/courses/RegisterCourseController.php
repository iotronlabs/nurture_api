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
            't_id' => ['required', 'string',  'max:255'],
            'sub_name' => ['required', 'string', 'min:1'],
            'sem' => ['required'],
            
            'current_sem' => ['required'],
            'c_day' => ['required'],

            

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

                'sub_id'  => 'SUB - '.$user->id.'',
            	'class_id' =>$user->class_id,
            	
               	//'t_ref_id' => $user-?t_ref_id,
               	't_id' => $user->t_id,
               	'sub_name'  => $user->sub_name,
               	'current_sem' => $user->current_sem,
                'status' => $user->status,
         				'c_day' => $user->c_day,
         				'time_start' => $user->time_start,
         				'time_end' => $user->time_end,
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
            'class_id' => $data['class_id'],
             't_id' => $data['t_id'],
              'sub_name' => $data['sub_name'],
            'sem' => $data['sem'],
            
            'current_sem' => $data['current_sem'],
            'c_day' => $data['c_day'],
            'time_start' => $data['time_start'],
            'time_end' => $data['time_end'],
           



        ]);
    }
}




