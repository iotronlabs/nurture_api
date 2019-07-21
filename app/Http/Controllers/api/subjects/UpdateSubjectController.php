<?php

namespace App\Http\Controllers\api\subjects;


use  Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use App\Models\Stream\subject_stream;
use App\Models\Topic\topic;
use App\Models\subject\subject;
use Auth;
use Config;
use Illuminate\Foundation\Auth\RegistersUsers;
use \DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use \Illuminate\Http\Request;

class UpdateSubjectController extends Controller
{
   protected function validator(array $data)
    {
        return Validator::make($data, [
           // 'class_id' => ['required', 'string', 'max:255'],
            'sub_name' => ['required', 'string',  'max:255'],
            'sub_code'  =>      ['required'],



  
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
            //    'data' => [

            //     'dept_id'  => 'DEP - '.$user->dept_id.'',
            //   'dept_name' =>$user->dept_name,
              
            //     //'t_ref_id' => $user-?t_ref_id,
            //     'stream_id' => $user->stream_id,
            //     'stream_name'  => $user->stream_name,
               
            //     'status' => $user->status,
            // 'course_length' => $user->course_length,
            // ]   
               
               //'token' => $token
           ],200);
       }
       return response()->json([
           
           'success' =>false,
           'errors' => $validator->errors()
           
       ]);
    }



    protected function create(array $data )
    {
        $create_subject = subject::create([

          'sub_name' => $data['sub_name'],
          'sub_code' => $data['sub_code'],
            //'dept_name' => $data['dept_name'], 
            // 'stream_id' => $data['']
            //'dept_name' => $data['dept_name'],
            // 'dept_id' => $data['dept_id'],
            // 'status' => 'Active',

            
           // 'department_id' => $data['department_id'],
            //'stream_id' => $data['stream_id'],

        ]);

        foreach ($data['topics'] as $topic) {
             topic::create([
            'topic_name' => $topic,
            'sub_id' => $create_subject->id,
        ]);
                
        
        }

        return $create_subject;
      
    }
     public function index()
        {
            $details=subject::all();
            return $details;
        }


     public function show(Request $request,$id)
    {
      $user= subject::findorfail($id);
      return response()->json
           ([
               'success' =>  true,
               'data' => $user,
               
           ],200);
   
      
    } 

  public function edit($id)
  {
         $project = subject::find($id);
         return response()->json
               ([
                   'success' =>  true,
                   'data' => $project,
                   
               ],200);
  }

public function update(Request $request, $id)
{
        $task = subject::findOrFail($id);
        $this->validate($request, [
          //'t_email' => 'required',
            'sub_code' => 'required',
            'sub_name' => 'required',
            // 'sub_stream' => 'required',
            // 'sub_department' => 'required',
            // 'status' => 'required',
        ]);
             $input_code = $request->sub_code;
             $input_name = $request->sub_name;

            $task->sub_code= $input_code;
            $task->sub_name = $input_name;

            $task->save();


		    //  return response()->json
		    //        ([
		    //            'success' =>  true,
		    //            'data' => $task,

		    //        ],200);

        // $input = $request->

        $data = $request->all();

        $task_3 = topic::where(['sub_id' => $id]);
            
        $task_3->delete();

        
        foreach ($data['topics'] as $topic) {
            topic::create([
            'topic_name' => $topic,
            'sub_id' => $id,
        ]);

        
        }
        
         return response()->json
               ([
                   'success' =>  true,
                   'data' => $task,
                   
               ],200);
  

}   


// public function getSubjects($stream_name)
// {
  
//    $data = subject_stream::where('stream_name',$stream_name)->get('sub_name');

//    return $data;
// }

public function destroy($sub_code)
{
   $data = subject::where('sub_code',$sub_code)->first('id');
   //   dd($data->id);
  Db::table('subjects')
        ->where('sub_code',$sub_code)
        ->delete();
   

   DB::table('topics')
       ->where('sub_id',$data->id)
       ->delete();

  //dd($task);
   return response()->json
               ([
                   'success' =>  true,
                   

               ],200);
}

}
