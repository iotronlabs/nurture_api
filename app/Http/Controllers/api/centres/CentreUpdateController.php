<?php

namespace App\Http\Controllers\api\centres;

use App\Http\Controllers\Controller;
use App\Models\centre\table_centre;
use Illuminate\Http\Request;


class CentreUpdateController extends Controller
{
  
	 public function index()
    {
        $user=table_centre::all();
        return $user;
    }





     public function show(Request $request,$centre_id)
    {
      $user= table_centre::findorfail($centre_id);
      return response()->json
           ([
               'success' =>  true,
               'data' => $user,
               
           ],200);
   
      
    } 

  public function edit($centre_id)
  {
     $project = table_centre::find($centre_id);
     return response()->json
           ([
               'success' =>  true,
               'data' => $project,
               
           ],200);
  }

public function update(Request $request, $centre_id)
{
		  	$task = table_centre::findOrFail($centre_id);
		    $this->validate($request, [
		    	'centre_name'=> 'required',
		    	
		    ]);

		    $input = $request->all();
		    $task->fill($input)->save();
	     	return response()->json
		           ([
		               'success' =>  true,
		               'data' => $task,
		               
		           ],200);
	

}


		public function destroy($centre_id)
		{
			    $task = table_centre::findOrFail($centre_id);

			    $task->delete();
			//dd($task);
			 return response()->json
				           ([
				               'success' =>  true,
				               // 'data' => '$task',
				               
				           ],200);

		}
}
