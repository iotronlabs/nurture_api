<?php

namespace App\Http\Controllers\api\Attendence;

use App\Http\Controllers\Controller;
use App\Models\Attendence\attendence;
use App\Models\classes\table_classes;
use App\Models\student\user_student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AttendenceController extends Controller
{


    protected function validator(array $data)
    {
        $combineunique = Rule::unique('attendences')->where('s_id',$data['s_id'])
                                                    ->where('date',$data['date']);

        return Validator::make($data,[

            's_id' => $combineunique,

        ]);
    }
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
            $validator=$this->validator($student);

            if(!$validator->fails())
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
            else
            {
                 return response()->json
                    ([
                        'success' => false,
                        'message' => 'Already recorded'
                    ],200);

            }
        }

        return response()->json
        ([
            'success' => true,

        ],200);
    }

	public function index(Request $request)
	{

		return attendence::where('center_name',$request->centre)
						->where('class_name',$request->class)
						->where('date',$request->date)
						->get();

	}

	public function show(Request $request)
	{

		$data = attendence::where('center_name',$request->centre)
						->where('class_name',$request->class)
						->where('s_id',$request->s_id)
						->get(['status','date']);

		$count = $data->count();
		$present = 0;
		foreach ($data as $key => $datum) {
			if($datum['status']==1)
			{
				$present++;
			}
		}

		$absent = $count - $present;

		return response()->json([

			'data' => $data,
			'count' => $count,
			'present' => $present,
			'absent' => $absent,
		]);

	}

}
