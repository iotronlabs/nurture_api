<?php

namespace App\Http\Controllers\api\teachers\Auth;

use App\Models\teacher\user_teacher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
//use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
//use App\Http\Controllers\Controller;

class TeacherUpdateController extends Controller
{
 
    public function show()
    {


      $user_teacher= user_teacher::all();

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
						        't_gender' => 'required'
						    ]);

						    $input = $request->all();

						    $task->fill($input)->save();


						     return response()->json
						           ([
						               'success' =>  true,
						               'data' => $task,
						               
						           ],200);
					

			  }




			  public function destroy($t_id)
			{
					    $task = user_teacher::findOrFail($t_id);

					    $task->delete();

			   	dd($task);
			   	 return response()->json
						           ([
						               'success' =>  true,
						               'data' => 'You have Successfully delete the details',
						               
						           ],200);

			    //return redirect()->route('api/teachers/Auth/teacherController');
			}

			
}	

