<?php

namespace App\Http\Controllers\api\exams;

use  Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use App\Http\Controllers\api\exams\edit_question;
use App\Models\Exam\examination;
use App\Models\Exam\question;
use App\Models\teacher\user_teacher;
use Auth;
use Config;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use \Illuminate\Http\Request;

class QuestionController extends Controller
{   

    /**
     * Class constructor.
     */
    public function __construct()
    {
        $this->middleware('authteachers');
    }
   protected function validator(array $data)
    {
        return Validator::make($data, [
           // 'class_id' => ['required', 'string', 'max:255'],
            
            'type'  => ['required'],
            'question' => ['required','unique:questions'],
 
        ]);
    }

    public function add_question(Request $request,examination $exam)
    {   
      
       $validator=$this->validator($request->all());
        
       if(!$validator->fails())
       {
           $user= $this->create($request->all(),$exam);
          
             
           
           return response()->json
           ([
           		
           		
               'success' =>  true,
              
               'data' => [
                'question_code' => $user->question_id,
                'exam_id' => $user->exam_id,
               ],
               
               //'token' => $token
           ],200);
       }
       return response()->json([
           
           'success' =>false,
           'errors' => $validator->errors()
           
       ]);
    }



    protected function create(array $data,examination $exam)
    {   
        //   dd($exam->exam_code);
        return question::create([
          
            'question_id'  => 'QES-'.mt_rand(0001,9999).'',
            'exam_id' => $exam->exam_code,
	        'type' => $data['type'],
            'question' => $data['question'],
            'option_1' => $data['option_1'],
            'option_2' => $data['option_2'],
            'option_3' => $data['option_3'],
            'option_4' => $data['option_4'],
            'answer' => $data['answer'],  
     
        ]);
      }
      public function  show_question(examination $exam)
      {
          $details = $exam->questions()->get();
        //   dd($details);
          return response()->json
              ([
                  'success' =>  true,
                  'data' => $details,
                   
              ],200);
      }

      public function edit_question(question $question)
     
       {
        
       $details = $question;

       return response()->json
              ([
                  'success' =>  true,
                  'data' => $details,
                   
              ],200);

      }
      public function update_question(Request $request, question $question)
     
       
      {
        
        $details = $question->update([
            'type' => $request->type,
            'question' => $request->question,
            'option_1' => $request->option_1,
            'option_2' => $request->option_2,
            'option_3' => $request->option_3,
            'option_4' => $request->option_4,
            'answer' => $request->answer,

        ]);

       

       return response()->json
              ([
                  'success' =>  true,
                  'data' => $details,
                   
              ],200);

      }

    public function delete_question(question $question)
    {
         
            $question->delete();
             return response()->json
              ([
                  'success' =>  true,
                  
                   
              ],200);
}

    

      


}
