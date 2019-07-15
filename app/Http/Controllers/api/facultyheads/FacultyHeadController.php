<?php

namespace App\Http\Controllers\api\facultyheads;

use App\Http\Controllers\Controller;
use App\Models\faculty\user_faculty_head;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FacultyHeadController extends Controller
{
    public function index()
    {
        $user_details=user_faculty_head::all();
        return $user_details;
    }


     public function show(Request $request,$faculty_head_id)
    {


      $user= user_faculty_head::findorfail($faculty_head_id);

      return response()->json
           ([
               'success' =>  true,
               'data' => $user,

           ],200);


    }

  


public function destroy($faculty_head_id)
{
	    $task = user_faculty_head::findOrFail($faculty_head_id);

	    $task->delete();

	//dd($task);
	 return response()->json
		           ([
		               'success' =>  true,
		           ],200);

//return redirect()->route('api/teachers/Auth/teacherController');
}

 public function edit($faculty_head_id)
  {

     $project = user_faculty_head::find($faculty_head_id);

     return response()->json
           ([
               'success' =>  true,
               'data' => $project,

           ],200);
  }

public function update(Request $request, $faculty_head_id)
{

       

        $task = user_faculty_head::findOrFail($faculty_head_id);


        $this->validate($request, [
          'faculty_head_email' => 'required',
          'faculty_head_gender' => 'required',
          'faculty_head_fname' =>  'required',
          'faculty_head_contact'  => 'required',
          'faculty_head_dob' =>    'required',
          'faculty_head_address'  => 'required',
          'faculty_head_address_city' => 'required',
          'faculty_head_address_state'=> 'required',
          'faculty_head_address_pin' => 'required',
          // 'faculty_profile_picture' => 'required',
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
               'data' => Auth::guard('faculty_heads')->user(),
               // 'token' => $token
           ],200);
  }
}
