<?php

namespace App\Http\Controllers\api\courses;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\course\table_course;


class CourseUpdateController extends Controller
{
   
	 public function index()
    {
        $user_details=table_course::all();
        return $user_details;
    }





     public function show(Request $request,$course_id)
    {
      $user= table_course::findorfail($course_id);
      return response()->json
           ([
               'success' =>  true,
               'data' => $user,
               
           ],200);
   
      
    } 

  public function edit($course_id)
  {
     $project = table_course::find($course_id);
     return response()->json
           ([
               'success' =>  true,
               'data' => $project,
               
           ],200);
  }

public function update(Request $request, $course_id)
{
		  	$task = table_course::findOrFail($course_id);
		    $this->validate($request, [
		    	'course_name'=> 'required',
		    	'course_duration' => 'required',

		    ]);

		    $input = $request->all();
		    $task->fill($input)->save();
	     	return response()->json
		           ([
		               'success' =>  true,
		               'data' => $task,
		               
		           ],200);
	

}


		public function destroy($sub_id)
		{
			    $task = table_course::findOrFail($sub_id);

			    $task->delete();
			//dd($task);
			 return response()->json
				           ([
				               'success' =>  true,
				               // 'data' => '$task',
				               
				           ],200);

		}
}
