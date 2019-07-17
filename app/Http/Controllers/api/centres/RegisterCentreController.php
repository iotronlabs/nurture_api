<?php

namespace App\Http\Controllers\api\centres;


use  Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use App\Models\centre\table_centre;
use Auth;
use Config;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use \Illuminate\Http\Request;

class RegisterCentreController extends Controller
{
    protected function validator(array $data)
    {
        return Validator::make($data, [
           // 'class_id' => ['required', 'string', 'max:255'],
           
            'centre_name' => ['required','unique:table_centres']
            
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

     return table_centre::create([
           
      'centre_name' => $data['centre_name'],

        ]);
    }
}




