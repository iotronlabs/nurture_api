<?php

namespace App\Http\Controllers\api\topics;

use App\Models\Topic\topic;
use \Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use  Tymon\JWTAuth\Facades\JWTAuth;
use Config; 
use Auth;


class UpdateTopicController extends Controller
{
    protected function validator(array $data)
    {
        return Validator::make($data, [
           // 'class_id' => ['required', 'string', 'max:255'],
            'topic_name' => ['required', 'string',  'max:255'],
            'sub_id'  => ['required'],


  
        ]);
    }

    public function register(Request $request)
    {
        $validator=$this->validator($request->all());
        
       if(!$validator->fails())
       {
           $user= $this->create($request->all());
           
           
           
           return response()->json
           ([
           		
           		
               'success' =>  true,
               'data' => $user,
               
               //'token' => $token
           ],200);
       }
       return response()->json([
           
           'success' =>false,
           'errors' => $validator->errors()
           
       ]);
    }



    protected function create(array $data)
    { 
        return topic::create([
            'topic_name' => $data['topic_name'],
             'sub_id' => $data['sub_id'],
            //   'stream_name' => $data['stream_name'],
            // 'course_length' => $data['course_length'],
            'status' => $data['status'],
     
        ]);
    }

     public function index()
		    {
		        $details=topic::all();
		        return $details;
		    }


     public function show(Request $request,$topic_id)
    {
      $user= topic::findorfail($topic_id);
      return response()->json
           ([
               'success' =>  true,
               'data' => $user,
               
           ],200);
   
      
    } 

  public function edit($topic_id)
  {
		     $project = topic::find($topic_id);
		     return response()->json
		           ([
		               'success' =>  true,
		               'data' => $project,
		               
		           ],200);
  }

public function update(Request $request, $topic_id)
{
		  	$task = topic::findOrFail($topic_id);
		    $this->validate($request, [
		    	//'t_email' => 'required',
		        'topic_name' => 'required',
		        'subject_id' => 'required',
		        'status' => 'required',
		        


		    ]);

		    $input = $request->all();
		    $task->fill($input)->save();
		     return response()->json
		           ([
		               'success' =>  true,
		               'data' => $task,
		               
		           ],200);
	

}		
}
