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





     public function show(Request $request,$sub_id)
    {
      $user= table_course::findorfail($sub_id);
      return response()->json
           ([
               'success' =>  true,
               'data' => $user,
               
           ],200);
   
      
    } 

  public function edit($sub_id)
  {
     $project = table_course::find($sub_id);
     return response()->json
           ([
               'success' =>  true,
               'data' => $project,
               
           ],200);
  }

public function update(Request $request, $sub_id)
{
		  	$task = table_course::findOrFail($sub_id);
		    $this->validate($request, [
		    	//'t_email' => 'required',
		        't_id' => 'required',
		        'sub_name' => 'required',
		        'sem' => 'required',
		        'current_sem' => 'required',
		        'c_day' => 'required',
		        'time_start' => 'required',
		        'time_end' => 'required',

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
				               'data' => '$task',
				               
				           ],200);

		}
}
