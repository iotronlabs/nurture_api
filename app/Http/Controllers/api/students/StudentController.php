<?php

namespace App\Http\Controllers\api\students;
use App\Http\Controllers\Controller;
use App\Models\Exam\examination;
use App\Models\student\user_student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{	
    public function index()
    {
        $user_details=user_student::all();
        return $user_details;
    }


     public function show(Request $request,$s_id)
    {


      $user= user_student::findorfail($s_id);

      return response()->json
           ([
               'success' =>  true,
               'data' => $user,

           ],200);


    }

  public function edit($s_id)
  {

     $project = user_student::find($s_id);

     return response()->json
           ([
               'success' =>  true,
               'data' => $project,

           ],200);
  }

public function update(Request $request, $s_id)
{


		  	$task = user_student::findOrFail($s_id);

		    $this->validate($request, [
		        's_email' => 'required',
		        's_gender' => 'required',
		        's_fname' =>  'required',
		        // 's_mname' =>  'required',
		        's_contact'  => 'required',
		        's_dob' =>    'required',
		        's_age' => 'required',
		        's_nationality' => 'required',
		        's_religion' => 'required',
		        's_address'  => 'required',
		        's_religion' => 'required',
		        's_address_pin' => 'required',
		        'guardian_fname' => 'required',
		        // 'guardian_mname' => 'required',
		      'guardian_surname' => 'required',
		        'guardian_email' => 'required',
		        'guardian_contact' => 'required',
		        'guardian_address' => 'required',
		        // 'guardian_state' => 'required',
		        'guardian_pin' => 'required',
		        // 'guardian_state' => 'required',
		        'guardian_city' => 'required',
		        's_address_city' => 'required',
		        's_surname' => 'required'

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


public function destroy($s_id)
{
	    $task = user_student::findOrFail($s_id);

	    $task->delete();

	//dd($task);
	 return response()->json
		           ([
		               'success' =>  true,
		               'data' => '$task',

		           ],200);

//return redirect()->route('api/teachers/Auth/teacherController');
}

	public function show_exam(user_student $student)
			{
				

				$exams = $student->exams()->get();
                 
                return response()->json
		           ([
		               'success' =>  true,
		               'data' => $exams,
		               
		           ],200);
				
			}

	public function usercheck(Request $request)	
	{
		return response()->json
           ([
               'success' =>  true,
               'data' => Auth::guard('students')->user(),
               // 'token' => $token
           ],200);
	}	


	public function userlogout()
	{
		Auth::guard('students')->logout();

		return response()->json
           ([
               'success' =>  true,
               // 'data' => $request->user(),
               // 'token' => $token
           ],200);
	}

	
}

