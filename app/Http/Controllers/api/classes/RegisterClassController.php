<?php

namespace App\Http\Controllers\api\classes;


use App\Models\classes\table_classes;
use App\Models\teacher\user_teacher;
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
            'start_date' => ['required'],
            'end_date' => ['required'],
            // 'standard' => ['required', 'string', 'min:1'],
            // 'section' => ['required', 'max:1'],

            // 'ct_id' => ['required'],


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

                'start_date'=> 	$user->start_date,
                // 'standard' =>      $user->standard,
                'class_id'  => 'DEP - '.$user->class_id.'',
               	//'t_ref_id' => $user-?t_ref_id,
               	'end_date' => $user->end_date,
               	// 'section'  => $user->section,
               	// 'ct_id' => $user->('SELECT '),
               	'status' => $user->status,

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
        //$t_name = $data['class_teacher'];
        // $ct_id = user_techer::select('SELECT t_id FROM user_teachers WHERE t_fname=?',[$t_name]);

        $ct_id = user_teacher::where('t_fname',$data['t_fname'])
                       ->where('t_mname',$data['t_mname'])
                       ->where('t_surname',$data['t_surname'])
                       ->first('t_id');

        $ct_id->toArray();               

        return table_classes::create([
            'class_name' => $data['class_name'],
            'start_date' => $data['start_date'],
            'end_date' => $data['end_date'],
            'class_stream' => $data['class_stream'],
            'ct_id' => $ct_id['t_id'],
            'status' => 111,//$data['status'],
            // 'standard' => $data['standard'],
            // 'section' => $data['section'],
        ]);
    }


}
