<?php

namespace App\Http\Controllers\api\Departments;


use App\Models\Department\department;
use \Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use  Tymon\JWTAuth\Facades\JWTAuth;
use Config;
use Auth;

class UpdateDepartmentController extends Controller
{
   protected function validator(array $data)
    {
        return Validator::make($data, [
           // 'class_id' => ['required', 'string', 'max:255'],
            'department_name' => ['required', 'string',  'max:255'],
            'department_code'  => ['unique:departments' ,'required'],



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
        return department::create([
            'department_name' => $data['department_name'],
             'department_code' => $data['department_code'],

            'status' => 'Active',

        ]);
      }
		 public function index()
		    {
		        $details=department::all();
		        return $details;
		    }


     public function show(Request $request,$id)
    {
      $user= department::findorfail($id);
      return response()->json
           ([
               'success' =>  true,
               'data' => $user,

           ],200);


    }

  public function edit($id)
  {
		     $project = department::find($id);
		     return response()->json
		           ([
		               'success' =>  true,
		               'data' => $project,

		           ],200);
  }

public function update(Request $request, $id)
{
		  	$task = department::findOrFail($id);
		    $this->validate($request, [
		    	'department_name' => 'required',
		        'department_code' => 'required',

		        'status' => 'required',


		    ]);

		    $input = $request->all();
		    $task->fill($input)->save();
		     return response()->json
		           ([
		               'success' =>  true,
		               'data' => $task,

		           ],200);


}

// Delete the stream and Delete the department is not be alvalable for any users//
//Only can be activated and deactivate//
}
