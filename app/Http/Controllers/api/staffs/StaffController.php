<?php

namespace App\Http\Controllers\api\staffs;

use App\Http\Controllers\Controller;
use App\Models\staff\user_staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StaffController extends Controller
{
    public function index()
    {
        $user_details=user_staff::all();
        return $user_details;
    }

     public function show(Request $request,$st_id)
    {


      $user_staff= user_staff::findorfail($st_id);

      return response()->json
           ([
               'success' =>  true,
               'data' => $user_staff,
               
           ],200);
   
      
    } 

  public function edit($st_id)
  {

     $project = user_staff::find($st_id);

     return response()->json
           ([
               'success' =>  true,
               'data' => $project,
               
           ],200);
  }

public function update(Request $request, $st_id)
{


		  	$task = user_staff::findOrFail($st_id);

		    $this->validate($request, [
		        'st_email' => 'required',
		        'st_gender' => 'required' ,
		        'st_fname' => 'required',
		        'st_mname' => 'required',
		        'st_surname' => 'required',
		        'st_dob' => 'required',
		        'st_age' => 'required',
		        'st_contact' => 'required',
		        'st_nationality' => 'required',
		        'st_religion'  => 'required',
		        'st_address' => 'required',
		        'st_address_pin'=> 'required',
		        'st_address_city'=> 'required',
		        'st_address' => 'required'
		           // all required field need to be added here whatever data to be edited is required.   Admin pay attention here//
		   
		    ]);

		    $input = $request->all();

		    $task->fill($input)->save();


		     return response()->json
		           ([
		               'success' =>  true,
		               'data' => $task,
		               
		           ],200);
	

}
	
	public function usercheck(Request $request)	
	{	
			// dd('hell');
		return response()->json
           ([
               'success' =>  true,
               'data' => Auth::guard('user_staffs')->user(),
               // 'token' => $token
           ],200);
	}	


public function destroy($st_id)
{
	    $task = user_staff::findOrFail($st_id);

	    $task->delete();

	//dd($task);
	 return response()->json
		           ([
		               'success' =>  true,
		               'data' => '$task',
		               
		           ],200);

//return redirect()->route('api/teachers/Auth/teacherController');
}
}
