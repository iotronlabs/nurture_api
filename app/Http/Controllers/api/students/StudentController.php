<?php

namespace App\Http\Controllers\api\students;
use App\Http\Controllers\Controller;

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

  


public function destroy($s_id)
{
	    $task = user_student::findOrFail($s_id);

	    $task->delete();

	//dd($task);
	 return response()->json
		           ([
		               'success' =>  true,
		               'data' => $task,

		           ],200);

//return redirect()->route('api/teachers/Auth/teacherController');
}



	// public function show_exam(user_student $student)
	// 		{
				

	// 			$exams = $student->exams()->get();
                 
 //                return response()->json
	// 	           ([
	// 	               'success' =>  true,
	// 	               'data' => $exams,
		               
	// 	           ],200);
				
	// 		}

	// public function usercheck(Request $request)	
	// {
	// 	return response()->json
 //           ([
 //               'success' =>  true,
 //               'data' => Auth::guard('students')->user(),
 //               // 'token' => $token
 //           ],200);
	// }	


	// public function userlogout()
	// {
	// 	Auth::guard('students')->logout();

	// 	return response()->json
 //           ([
 //               'success' =>  true,
 //               // 'data' => $request->user(),
 //               // 'token' => $token
 //           ],200);
	// }

	
}

