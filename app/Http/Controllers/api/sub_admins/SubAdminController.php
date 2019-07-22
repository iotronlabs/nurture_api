<?php

namespace App\Http\Controllers\api\sub_admins;

use App\Http\Controllers\Controller;
use App\Models\faculty\user_faculty;
use App\Models\student\user_student;
use App\Models\sub_admin\user_sub_admin;
use Auth;
use Illuminate\Http\Request;

class SubAdminController extends Controller
{
     public function index()
    {
        $user_details=user_sub_admin::all();
        return $user_details;
    }


     public function show(Request $request,$sub_admin_id)
    {


      $user= user_sub_admin::findorfail($sub_admin_id);

      return response()->json
           ([
               'success' =>  true,
               'data' => $user,

           ],200);


    }

  


public function destroy($sub_admin_id)
{
	    $task = user_sub_admin::findOrFail($sub_admin_id);

	    $task->delete();

	//dd($task);
	 return response()->json
		           ([
		               'success' =>  true,
		           ],200);

//return redirect()->route('api/teachers/Auth/teacherController');
}

 public function edit($sub_admin_id)
  {

     $project = user_sub_admin::find($sub_admin_id);

     return response()->json
           ([
               'success' =>  true,
               'data' => $project,

           ],200);
  }

public function update(Request $request, $sub_admin_id)
{

       

        $task = user_sub_admin::findOrFail($sub_admin_id);


        $this->validate($request, [
          'sub_admin_email' => 'required',
          'sub_admin_gender' => 'required',
          'sub_admin_fname' =>  'required',
          'sub_admin_contact'  => 'required',
          'sub_admin_dob' =>    'required',
          'sub_admin_address'  => 'required',
          'sub_admin_address_city' => 'required',
          'sub_admin_address_state'=> 'required',
          'sub_admin_address_pin' => 'required',
          'sub_admin_centre' => 'required',
          // 'sub_admin_profile_picture' => 'required',
          // 'status' => 'required',

               //edit here if required to update content//
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
    return response()->json
           ([
               'success' =>  true,
               'data' => Auth::guard('sub_admins')->user(),
               // 'token' => $token
           ],200);
  }

public function userlogout()
  {
    Auth::guard('sub_admins')->logout();

    return response()->json
           ([
               'success' =>  true,
               // 'data' => $request->user(),
               // 'token' => $token
           ],200);
  }

  public function get_student_details($centre)
  {

    $data = user_student::where('s_centre',$centre)->get();
     return response()->json
           ([
               'success' =>  true,
                'data' => $data,
               // 'token' => $token
           ],200);

  }

  public function get_faculty_details($centre)
  {

    $data = user_faculty::where('faculty_centre',$centre)->get();
     return response()->json
           ([
               'success' =>  true,
                'data' => $data,
               // 'token' => $token
           ],200);

  }


}
