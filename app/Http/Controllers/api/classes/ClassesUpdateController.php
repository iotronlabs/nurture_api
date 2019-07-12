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
		        'start_date'  => 'required',
		        'end_date'   => 'required',
		        // 'standard'    => 'required',
		        // 'section'   => 'required',
		        // 'ct_id'   =>  'required',

	           ]);

		    $ct_id = user_teacher::where('t_fname',$request->t_fname)
                       ->where('t_mname',$request->t_mname)
                       ->where('t_surname',$request->t_surname)
                       ->first('t_id');

            $ct_id->toArray();          

		    $task->class_name = $request->class_name;
		    $task->start_date = $request->start_date;
		    $task->end_date = $request->end_date;
		    $task->class_stream = $request->class_stream;
            $task->ct_id = $ct_id['t_id'];

            $task->save();

		    // $input = $request->all();
		    // $task->fill($input)->save();
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
}
