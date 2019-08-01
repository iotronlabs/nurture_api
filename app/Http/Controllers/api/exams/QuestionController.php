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
use Symfony\Component\HttpFoundation\File\getClientOriginalExtension;
use \Illuminate\Http\Request;

class QuestionController extends Controller
{


   protected function validator(array $data)
    {
        return Validator::make($data, [
        //    'class_id' => ['required', 'string', 'max:255'],

            'type'  => ['required'],
            'question' => ['required'],
            'answer' => ['required'],


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

               'data' => $user,

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

        $request = request();
        // $Image = $data['image'];
        if($request->file('question_image')!=null)
        {
              $image_question = $request->file('question_image');
              $ImageSaveAsName = time() . Auth::id().
                                      $image_question->getClientOriginalExtension();

              $upload_path = 'exams/question';
              $image_url_question =  $ImageSaveAsName;
              $image_question->move($upload_path, $ImageSaveAsName);

        }
        else
        {
             $image_url_question = "null";
        }


      if($request->file('option_5')!=null)
        {
              $image_option5 = $request->file('option_5');
              $ImageSaveAsOption5 = time() . Auth::id().
                                      $image_option5->getClientOriginalExtension();

              $upload_path = 'exams/question';
              $image_url_option5 =  $ImageSaveAsOption5;
              $image_option5->move($upload_path, $ImageSaveAsOption5);

        }
        else
        {
             $image_url_option5 = "null";
        }



          if($request->file('option_6')!=null)
        {
              $image_option6 = $request->file('option_6');
              $ImageSaveAsOption6 = time() . Auth::id().
                                      $image_option6->getClientOriginalExtension();

              $upload_path = 'exams/question';
              $image_url_option6 =  $ImageSaveAsOption6;
              $image_option6->move($upload_path, $ImageSaveAsOption6);

        }
        else
        {
             $image_url_option6 = "null";
        }





          if($request->file('option_7')!=null)
        {
              $image_option7 = $request->file('option_7');
              $ImageSaveAsOption7 = time() . Auth::id().
                                      $image_option7->getClientOriginalExtension();

              $upload_path = 'exams/question';
              $image_url_option7 =  $ImageSaveAsOption7;
              $image_option7->move($upload_path, $ImageSaveAsOption7);

        }
        else
        {
             $image_url_option7 = "null";
        }


          if($request->file('option_8')!=null)
        {
              $image_option8 = $request->file('option_8');
              $ImageSaveAsOption8 = time() . Auth::id().
                                      $image_option8->getClientOriginalExtension();

              $upload_path = 'exams/question';
              $image_url_option8 =  $ImageSaveAsOption8;
              $image_option8->move($upload_path, $ImageSaveAsOption8);

        }
        else
        {
             $image_url_option8 = "null";
        }



        $data1 =  question::create([

            'exam_id' => $exam->id,
	          'type' => $data['type'],
            'question' => $data['question'],
            'option_1' => $data['option_1'],
            'option_2' => $data['option_2'] ,
            'option_3' => $data['option_3'],
            'option_4' => $data['option_4'],
            'option_5' => $image_url_option5,
            'option_6' => $image_url_option6,
            'option_7' => $image_url_option7,
            'option_8' => $image_url_option8,
            'topics' => $data['topics'],

            'answer' => $data['answer'],

            'question_image' => $image_url_question,

        ]);

        // $success = $Image->move($upload_path, $ImageSaveAsName);
        return $data1;



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


        $request = request();

        $Image = $request->file('image');
        $ImageSaveAsName = time() . Auth::id() . "-profile." .
                                  $Image->getClientOriginalExtension();

        $upload_path = 'exams/question';
        $image_url =  $ImageSaveAsName;
        $success = $Image->move($upload_path, $ImageSaveAsName);


        $details = $question->update([
            'type' => $request->type,
            'question' => $request->question,
            'option_1' => $request->option_1,
            'option_2' => $request->option_2,
            'option_3' => $request->option_3,
            'option_4' => $request->option_4,
            'answer' => $request->answer,
            'image'  => $image_url,

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
