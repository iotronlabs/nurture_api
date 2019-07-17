<?php

namespace App\Http\Controllers\api\faculty;

use App\Http\Controllers\Controller;
use App\Models\faculty\user_faculty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class FacultyController extends Controller
{ 


    public function index()
    {
        $user_details=user_faculty::all();
        return $user_details;
    }


     public function show(Request $request,$faculty_id)
    {


      $user= user_faculty::findorfail($faculty_id);

      return response()->json
           ([
               'success' =>  true,
               'data' => $user,

           ],200);


    }

  


    public function destroy($faculty_id)
    {
    	    $task = user_faculty::findOrFail($faculty_id);

    	    $task->delete();

    	//dd($task);
    	 return response()->json
    		           ([
    		               'success' =>  true,
    		           ],200);

    //return redirect()->route('api/teachers/Auth/teacherController');
    }


   public function edit($faculty_id)
    {

       $project = user_faculty::find($faculty_id);

       return response()->json
             ([
                 'success' =>  true,
                 'data' => $project,

             ],200);
    }

    public function update(Request $request, $faculty_id)
    {

           

            $task = user_faculty::findOrFail($faculty_id);


            $this->validate($request, [
              'faculty_email' => 'required',
              'faculty_gender' => 'required',
              'faculty_fname' =>  'required',
              'faculty_contact'  => 'required',
              'faculty_dob' =>    'required',
              'faculty_address'  => 'required',
              'faculty_address_city' => 'required',
              'faculty_address_state'=> 'required',
              'faculty_address_pin' => 'required',
              'faculty_centre' => 'required',
              'faculty_sub' => 'required',
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
                   'data' => Auth::guard('faculties')->user(),
                   // 'token' => $token
               ],200);
      }

public function userlogout()
  {
    Auth::guard('faculties')->logout();

    return response()->json
           ([
               'success' =>  true,
               // 'data' => $request->user(),
               // 'token' => $token
           ],200);
  }


    }
