<?php

namespace App\Http\Controllers\api\streams;


use  Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use App\Models\Department\department;
use App\Models\Stream\stream;
use App\Models\Stream\subject_stream;
use App\Models\subject\subject;
use Auth;
use Config;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use \DB;
use \Illuminate\Http\Request;

class UpdateStreamController extends Controller
{
   protected function validator(array $data)
    {
        return Validator::make($data, [
           // 'class_id' => ['required', 'string', 'max:255'],
            'stream_name' => ['required', 'string',  'max:255'],
            'stream_code'  =>      ['required'],




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



    protected function create(array $data)
    {


        $code = department::where('department_name',$data['department_name'])->first();
        $user = $code->toArray();


        $create_stream =  stream::create([

            //'dept_name' => $data['dept_name'],
             'stream_name' => $data['stream_name'],
             'stream_code' => $data['stream_code'],
             'department_code' => $user['department_code'],  //$data['department_code'],
             'department_name' => $data['department_name'],
             'course_length' => $data['course_length'],
            //  'Assign_Subject' => $data['Assign_Subject'],
            // 'stream_id' => $data['']
              //'dept_name' => $data['dept_name'],
           // 'dept_id' => $data['dept_id'],
           // 'status' => $data['status'],
           // 'department_id' => $data['department_id'],
            //'stream_id' => $data['stream_id'],

        ]);


        foreach ($data['subjects'] as $subject) {

             $task = subject::where(['sub_name' => $subject])->first('sub_code');

             $task->toArray();


            $user_insert =  subject_stream::create([

                'sub_name' => $subject,
                'sub_code' => $task['sub_code'],
                'stream_name' => $data['stream_name'],
                'department_name' => $data['department_name'],

             ]);
             //  get sub_name and sub_code from subject in $task

              //  DB::table('subject_stream')
              //     ->where('sub_name',$subject)
              //     ->update([
              //         "sub_stream" => $data['stream_name'],
              //         "sub_department" => $data['department_name'],

              // ]);

             // Insert into subject_stream $task['sub_name'] and $task['sub_code'], $data['stream_name'] and $data['department_name']


        }
        return $user_insert;

    }


     public function index()
        {
            $details=stream::all();
            return $details;
        }


     public function show(Request $request,$id)
    {
      $user= stream::findorfail($id);
      return response()->json
           ([
               'success' =>  true,
               'data' => $user,

           ],200);


    }

  public function edit($id)
  {
         $project = stream::find($id);
         return response()->json
               ([
                   'success' =>  true,
                   'data' => $project,

               ],200);
  }

public function update(Request $request, $id)
{
        $task = stream::findOrFail($id);

        $duplicate_stream_name = $task->stream_name;
        $duplicate_dept_name = $task->department_name;



        $this->validate($request, [
          //'t_email' => 'required',
            'stream_code' => 'required',
            'stream_name' => 'required',
            // 'department_code' => 'required',
            'department_name' => 'required',
            'course_length' => 'required',
            //'status' => 'required',
        ]);


        $code = department::where('department_name',$request->department_name)->first();
        $user = $code->toArray();

        $task->stream_code = $request->stream_code;
        $task->stream_name = $request->stream_name;
        $task->department_name = $request->department_name;
        $task->course_length = $request->course_length;
        $task->department_code = $user['department_code'];

        $task->save();
    
        $data = subject_stream::where('stream_name',$duplicate_stream_name)
                              ->where('department_name',$duplicate_dept_name)
                              ->get('sub_name');
        
        $data->toArray();

        
        for ($i=0; $i < sizeof($data) ; $i++) { 

          if(!in_array($data[$i]['sub_name'],$request->subjects))
          {
             DB::table('subject_stream')
                    ->where('sub_name',$data[$i]['sub_name'])
                    ->where('stream_name',$duplicate_stream_name)
                    ->where('department_name',$duplicate_dept_name)
                    ->delete();

                    
          } 
         
        }
  
        //  $data = $task->stream_name;

        //  DB::table('subjects')
        //     ->where('sub_stream',$data)
        //     ->update([
        //         "sub_stream" => NULL,
        //         "sub_department" => NULL,
        // ]);

         // $input = $request->all();





         foreach ($request->subjects as $subject) {

           // $task = subject::where(['sub_name' => $subject])->get();

          //  DB::table('subjects')
          //     ->where('sub_name',$subject)
          //     ->update([
          //         "sub_stream" => $request->stream_name,
          //         "sub_department" => $request->department_name,
          // ]);

          // Update subject_stream table
           $task = subject_stream::where('sub_name',$subject)
                                ->where('stream_name',$duplicate_stream_name)
                                ->where('department_name',$duplicate_dept_name);


            if($task->exists())
            {
                DB::table('subject_stream')
                    ->where('sub_name',$subject)
                    ->where('stream_name',$duplicate_stream_name)
                    ->where('department_name',$duplicate_dept_name)
                    ->update([
                        "stream_name" => $request->stream_name,
                        "department_name"=> $request->department_name,
                        ]);

            }
            else
            {
                $task = subject::where(['sub_name' => $subject])->first('sub_code');

                $task->toArray();


                $user_insert =  subject_stream::create([

                    'sub_name' => $subject,
                    'sub_code' => $task['sub_code'],
                    'stream_name' => $request->stream_name,
                    'department_name' => $request->department_name,

                ]);
            }

          



        }





        // $task->fill($input)->save();
         return response()->json
               ([
                   'success' =>  true,
                   //'data' => $task,

               ],200);




}

// Delete the stream and Delete the department is not be alvalable for any users//
//Only can be activated and deactivate//
}
