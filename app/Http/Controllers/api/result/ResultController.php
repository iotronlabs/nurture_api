<?php

namespace App\Http\Controllers\api\result;

use App\Http\Controllers\Controller;
use App\Models\Exam\examination;
use App\Models\Exam\question;
use App\Models\result\table_result;
use Auth;
use \DB;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    public function create($exam_id)
    {
    	$task = examination::findOrFail($exam_id);

    	//dd(Auth::guard('students')->user()->s_id);

    	table_result::create([

         's_id' => Auth::guard('students')->user()->s_id,
         'exam_id' => $exam_id,
         'exam_name' => $task->exam_name,
         'sub_name' => $task->subject_name,
         'total_question' => $task->t_questions,
         'status' => "TAKEN",

    	]);

    	return response()->json([
        
        'success' => true,

    	]);
    }

    public function check(Request $request,examination $exam)
    {
    	$task = question::select(['answer'])
    	         ->where('exam_id',$exam->id)
    	         ->get();
    	        
        $count = 0;

        for($i = 0; $i<sizeof($request->data);$i++)
        {
        	if($request->data[$i]==$task[$i]['answer'])
        	 {
        	 	$count = $count + 1;
        	 }	
        }
       
        $res = '';
        $pmarks = $exam->pass_mark;

        if($pmarks == null)
        {
        	$pmarks = 0.7 * $exam->t_questions; 	
        }

        if($count>=$pmarks)
        {
        	$res = 'PASS';
        }
        else
        {
        	$res = 'FAIL';
        }
       
        $sid = Auth::guard('students')->user()->s_id;
     
        DB::table('table_results')
        	->where('exam_id',$exam->id)
        	->where('s_id',$sid)
        	->update([

             'correct_answer' => $count,
             'result' => $res,
             
        	]);

        return response()->json([
        
        'success' => $count,


    	]);
    }
}
