<?php

namespace App\Http\Controllers\api\exams;


use  Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use App\Models\Exam\examination;


use Auth;
use Config;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use \Illuminate\Http\Request;

class ExaminationController extends Controller
{   

   protected function validator(array $data)
    {
        return Validator::make($data, [
           // 'class_id' => ['required', 'string', 'max:255'],
            'exam_name' => ['required', 'string',  'max:255'],
            'course_name'  => ['required'],
            'subject_name' => ['required'],
            'start_date' => ['required'],
            'end_date' => ['required'],
            'pass_mark' => ['required'],



  
        ]);
    }

   
    public function addexam(Request $request)
    { 

        $validator=$this->validator($request->all());
        
       if(!$validator->fails())
       {
           $user= $this->create($request->all());
           
           
           
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



    protected function create(array $data)
    {   

        return examination::create([
            'course_name' => $data['course_name'],
            'exam_name' => $data['exam_name'],
            'subject_name' => $data['subject_name'],
            'start_date' => $data['start_date'],
            'end_date' => $data['end_date'],
            'duration' => $data['duration'],
            'pass_mark' => $data['pass_mark'],
            
            'description' => $data['description'],
          
            

            
     
        ]);
      } 
       public function index()
    {

        $details = examination::all();

        return $details; 

    }

   public function show_question(examination $exam)
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
         
          $this->validate($request, [
         
           'course_name' => 'required',
           'subject_name' => 'required',
           
           'pass_mark' => 'required',
           'start_date' => 'required',
           'end_date' => 'required',



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





}
