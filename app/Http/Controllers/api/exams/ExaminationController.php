<?php

namespace App\Http\Controllers\api\exams;


use  Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use App\Models\Exam\examination;
use App\Models\teacher\user_teacher;
use App\Models\student\user_student;
use Auth;
use Config;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use \Illuminate\Http\Request;

class ExaminationController extends Controller
{   


    /**
     * Class constructor.
     */
    public function __construct()
    {
        $this->middleware('authteachers');
        $this->middleware('authstudents')->only('show_rules');
    }
   protected function validator(array $data)
    {
        return Validator::make($data, [
           // 'class_id' => ['required', 'string', 'max:255'],
            'exam_name' => ['required', 'string',  'max:255'],
            'topic'  => ['required'],
            'subject' => ['required'],
            'date' => ['required'],
            'pass_mark' => ['required'],



  
        ]);
    }

    public function index()
    {

        $details = examination::all();

        return $details; 

    }
    public function addexam(Request $request, user_teacher $teacher)
    {
        $validator=$this->validator($request->all());
        
       if(!$validator->fails())
       {
           $user= $this->create($request->all(),$teacher);
           
           
           
           return response()->json
           ([
           		
           		
               'success' =>  true,
               'data' =>  $user,
               
               //'token' => $token
           ],200);
       }
       return response()->json([
           
           'success' =>false,
           'errors' => $validator->errors()
           
       ]);
    }



    protected function create(array $data,user_teacher $teacher)
    { 
        return examination::create([

        		
            'exam_code' => 'EX-'.mt_rand(0001,9999).'',
            'topic' => $data['topic'],
            'exam_name' => $data['exam_name'],
            'subject' => $data['subject'],
            'date' => $data['date'],
            'duration' => $data['duration'],
            'pass_mark' => $data['pass_mark'],
            're_exam' => $data['re_exam'],
            'description' => $data['description'],
            'status' => $data['status'],
            'class_id' => $data['class_id'],
            'teacher_id_created' => $teacher->t_id,//$data['teacher_id_created'],

            
     
        ]);
      } 

//   public function edit($id)
//   {
// 		     $project = department::find($id);
// 		     return response()->json
// 		           ([
// 		               'success' =>  true,
// 		               'data' => $project,
		               
// 		           ],200);
//   }

// public function update(Request $request, $id)
// {
// 		  	$task = department::findOrFail($id);
// 		    $this->validate($request, [
// 		    	,
// 		        'department_name' => 'required',
// 		        'department_code' => 'required',
		       
// 		        'status' => 'required',


// 		    ]);

// 		    $input = $request->all();
// 		    $task->fill($input)->save();
// 		     return response()->json
// 		           ([
// 		               'success' =>  true,
// 		               'data' => $task,
		               
// 		           ],200);
	

// }		

// // Delete the stream and Delete the department is not be alvalable for any users//
// //Only can be activated and deactivate//

   public function get_question(examination $exam)
      { 
         //$exam_code = 'EX-4057';
         $questions = $exam->questions()->get();

             return response()->json
              ([
                  'success' =>  true,
                  'data' => $questions,
                   
              ],200);
         
      }

      public function edit_exam(examination $exam)
      {
       $details = $exam;
       return response()->json
              ([
                  'success' =>  true,
                  'data' => $details,
                   
              ],200);

      }


        public function update(Request $request,examination $exam)
        {
          $details = $exam->exam_code;
          $this->validate($request, [
         
           'topic' => 'required',
           'subject' => 'required',
           
           'pass_mark' => 'required',


       ]);
          // dd($details);

       $input = $request->all();
       //dd($input);


       $exam->update($input);

       // $details->fill($input)->save();
        return response()->json
              ([
                  'success' =>  true,
                  'data' => $exam,
                   
              ],200);
  


        }

        public function destroy (examination $exam)
        {
            $exam->delete();
             return response()->json
              ([
                  'success' =>  true,
                  
                   
              ],200);
        }

        public function deactivate_exam(Request $request, examination $exam)
        {   
            
            $exam->update(['status' => $request->status]);
            return response()->json([
                'success' => true,
            ]);

        }

    public function show_rules(examination $exam)
	{
		$details = $exam->exams()->get();
		dd($details);
	}

}
