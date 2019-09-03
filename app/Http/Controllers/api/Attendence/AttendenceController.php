<?php

namespace App\Http\Controllers\api\Attendence;

use App\Http\Controllers\Controller;
use App\Models\Attendence\attendence;
use App\Models\classes\table_classes;
use App\Models\student\user_student;
use Illuminate\Http\Request;

class AttendenceController extends Controller
{

	public function getclasses($center_name)
	{
		return table_classes::where('class_centre_name',$center_name)->get('class_name');
	}

	public function getstudents(Request $data)
	{
		return user_student::where('s_centre',$data->centre_name)
						->where('s_class',$data->class_name)
						->get(['s_id','s_fname','s_surname']);
       
	}

	public function add(Request $request)
	{
		foreach($request->students as $student)
		{
			attendence::create([

				 'center_name' => $student['centre_name'],
				 'class_name' => $student['class_name'],
				 's_id' => $student['s_id'],
				 's_fname' => $student['s_fname'],
				 's_surname' => $student['s_surname'],
				 'status' => $student['status'],
				 'date' => $student['date']

			]);
		}

		return response()->json
		([
			'success' => true,

		],200);
	}
    
}
