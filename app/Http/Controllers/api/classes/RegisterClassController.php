<?php

namespace App\Http\Controllers\api\classes;


use App\Models\classes\table_classes;

use \Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use  Tymon\JWTAuth\Facades\JWTAuth;
use Config;
use Auth;

class RegisterClassController extends Controller
{
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'start_time' => ['required'],
            'end_time' => ['required'],
            'course' => ['required'],
            'class_name' => ['required'],
           


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
        //$t_name = $data['class_teacher'];
        // $ct_id = user_techer::select('SELECT t_id FROM user_teachers WHERE t_fname=?',[$t_name]);

        // $ct_id = user_teacher::where('t_fname',$data['t_fname'])
        //                ->where('t_mname',$data['t_mname'])
        //                ->where('t_surname',$data['t_surname'])
        //                ->first('t_id');

        // $ct_id->toArray();               

        return table_classes::create([
            'class_name' => $data['class_name'],
            'start_time'=> $data['start_time'],
            'end_time' => $data['end_time'],
            'course' => $data['course'],
            
        ]);
    }


}
