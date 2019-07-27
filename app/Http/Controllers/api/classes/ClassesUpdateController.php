<?php

namespace App\Http\Controllers\api\classes;

use App\Http\Controllers\Controller;
use App\Models\classes\table_classes;
use App\Models\teacher\user_teacher;
use Illuminate\Http\Request;

class ClassesUpdateController extends Controller
{
    
   
	 public function index()
    {
        $user_details=table_classes::all();
        return $user_details;
    }





     public function show(Request $request,$class_id)
    {
      $user= table_classes::findorfail($class_id);
      return response()->json
           ([
               'success' =>  true,
               'data' => $user,
               
           ],200);
   
      
    } 

  public function edit($class_id)
  {
     $project = table_classes::find($class_id);
     return response()->json
           ([
               'success' =>  true,
               'data' => $project,
               
           ],200);
  }

public function update(Request $request, $class_id)
{
		  	$task = table_classes::findOrFail($class_id);
		    $this->validate($request, [
		    	//'t_email' => 'required',
		        'start_time'  => 'required',
		        'end_time'   => 'required',
		        // 'standard'    => 'required',
		        // 'section'   => 'required',
		        // 'ct_id'   =>  'required',

	           ]);

		   

		    $input = $request->all();
		    $task->fill($input)->save();
		     return response()->json
		           ([
		               'success' =>  true,
		               'data' => $task,
		               
		           ],200);
	

}


		public function destroy($class_id)
		{
			    $task = table_classes::findOrFail($class_id);

			    $task->delete();
			//dd($task);
			 return response()->json
				           ([
				               'success' =>  true,
				               'data' => '$task',
				               
				           ],200);

		}

		public function detail($class_centre_name)
		{

			//dd($class);

			 $user = table_classes::where('class_centre_name',$class_centre_name)->get();

             return response()->json([
             
                 'data' => $user,

             ]);
		 
		}
}
