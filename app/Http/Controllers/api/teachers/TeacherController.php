<?php

namespace App\Http\Controllers\api\teachers;

use Illuminate\Http\Request;
use App\Models\Exam\examination;
use App\Http\Controllers\Controller;

use App\Models\teacher\user_teacher;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    public function index()
    {
        $user_details=user_teacher::all();
        return $user_details;
    }

    public function show(Request $request,$t_id)
    {


      $user_teacher= user_teacher::findorfail($t_id);

      return response()->json
           ([
               'success' =>  true,
               'data' => $user_teacher,
               
           ],200);
   
      
    } 

  public function edit($t_id)
  {

     $project = user_teacher::find($t_id);

     return response()->json
           ([
               'success' =>  true,
               'data' => $project,
               
           ],200);
  }

public function update(Request $request, $t_id)
{


		  	$task = user_teacher::findOrFail($t_id);

		    $this->validate($request, [
		        't_email' => 'required',
		        't_gender' => 'required' ,
		        't_fname' => 'required',
		        't_mname' => 'required',
		        't_surname'  => 'required',
		        't_dob' => 'required',
		        't_age' => 'required',
		        't_contact' => 'required',
		        't_nationality' => 'required',
		        't_religion' => 'required',
		        't_address' => 'required',
		        't_address_pin' =>'required',
		        't_address_state' => 'required',
		        't_address_city' => 'required',
		        't_sub' => 'required',

		            //edit here for update purpose//
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
               'data' => Auth::guard('user_teachers')->user(),
               // 'token' => $token
           ],200);
	}	


public function destroy($t_id)
{
	    $task = user_teacher::findOrFail($t_id);

	    $task->delete();

	//dd($task);
	 return response()->json
		           ([
		               'success' =>  true,
		               'data' => $task,
		               
		           ],200);

//return redirect()->route('api/teachers/Auth/teacherController');
}

		public function get_exam(user_teacher $teacher)
			{
				

				$exams = $teacher->exams()->get();
                 
                return response()->json
		           ([
		               'success' =>  true,
		               'data' => $exams,
		               
		           ],200);
				
			}

}
