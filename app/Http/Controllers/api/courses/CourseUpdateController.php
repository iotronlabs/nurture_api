<?php

namespace App\Http\Controllers\api\courses;

use App\Http\Controllers\Controller;
use App\Models\course\subject_course;
use App\Models\course\table_course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class CourseUpdateController extends Controller
{

	 public function index()
    {
        $user_details=table_course::all();
        return $user_details;
    }





     public function show(Request $request,$course_id)
    {
      $user= table_course::findorfail($course_id);
      return response()->json
           ([
               'success' =>  true,
               'data' => $user,

           ],200);


    }

  public function edit($course_id)
  {
     $project = table_course::find($course_id);
     return response()->json
           ([
               'success' =>  true,
               'data' => $project,

           ],200);
  }

public function update(Request $request, $course_id)
{

		  	$task = table_course::findOrFail($course_id);


		    $this->validate($request, [
		    	'course_name'=> 'required',
		    	'course_duration' => 'required',

		    ]);

		    $name = $request->course_name;

		    //dd($name);

		    // DB::table('table_courses')
      //               ->where('course_id',$course_id)
      //               ->update([
      //                   'course_name' => $request->course_name,
      //                   'course_duration' => $request->course_duration,
      //                   ]);

		    $task->course_name = $request->course_name;
		    $task->course_duration = $request->course_duration;

		    $task->save();



            $data = subject_course::where('course_name',$name)->get('sub_name');

            $data->toArray();




            for ($i=0; $i < sizeof($data) ; $i++) {

		          if(!in_array($data[$i]['sub_name'],$request->subject))
		          {
		             DB::table('subject_courses')
		                    ->where('sub_name',$data[$i]['sub_name'])
		                    ->where('course_name',$name)
		                    ->delete();

		          }

       		 }

       	foreach ($request->subject as $subject) {


           $task = subject_course::where('sub_name',$subject)
                                ->where('course_name',$name);



            if($task->exists())
            {
                DB::table('subject_courses')
                    ->where('sub_name',$subject)
                    ->where('course_name',$name)
                    ->update([
                        "course_name" => $request->course_name,
                        ]);

            }
            else
            {

                $user_insert =  subject_course::create([

                    'sub_name' => $subject,
                    'course_name' => $request->course_name,

                ]);
            }

        }

	     	return response()->json
		           ([
		               'success' =>  true,


		           ],200);


}


		public function destroy($course_id)
		{
			    $task = table_course::findOrFail($course_id);

			    $task->delete();
			//dd($task);
			 return response()->json
				           ([
				               'success' =>  true,
				               // 'data' => '$task',

				           ],200);

		}

    public function get_sub($course_id)
    {
      $task  =  table_course::findorfail($course_id);
      $data =   subject_course:: where('course_name',$task->course_name)->get('sub_name');
       return response()->json
                   ([
                       'success' =>  true,
                        'data' => $data,

                   ],200);

      }
  }

