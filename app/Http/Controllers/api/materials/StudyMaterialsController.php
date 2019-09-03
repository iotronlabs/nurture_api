<?php

namespace App\Http\Controllers\api\materials;

use App\Http\Controllers\Controller;
use App\Models\Material\material;
use Auth;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use \DB;
use \File;
use \Illuminate\Http\Request;

class StudyMaterialsController extends Controller
{
    protected function validator(array $data)
    {
        return Validator::make($data, [
           // 'class_id' => ['required', 'string', 'max:255'],
            'title' => ['required', 'string',  'max:255'],
            'course'  => ['required'],
            'subject' => ['required'],

  
        ]);
    }

    public function add(Request $request)
    {
        $validator=$this->validator($request->all());
        
       if(!$validator->fails())
       {
           $user= $this->create($request->all());
           
           
           
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



    protected function create(array $data)
    { 	
			$request = request();
	    	 if($request->file('upload_file')!=null)
        	 {
	            $file = $request->file('upload_file');
	            $fileSaveAsName = time() . Auth::id() . "-file." .
	                                    $file->getClientOriginalExtension();

	            $upload_path = 'studymaterials/';
	            $new_file =  $fileSaveAsName;
	        }
	        else
	        {
	            $new_file=null;
	        }

	        $data = material::create([
	            'title' => $data['title'],
	             'description' => $data['description'],
	           	 'course' => $data['course'],
	           	 'subject' => $data['subject'],
	           	 'upload_file' => $new_file,
	           	 'topic' => $data['topic'],

	     
	        ]);

	        if($data!=null)
	        {
	            $success = $file->move($upload_path, $fileSaveAsName);
	        }

	       return $data;  

    }
  
        public function show(Request $request,$id)
    {


	      $data= material::findOrfail($id);

	      return response()->json
	           ([
               'success' =>  true,
               'data' => $data,

           ],200);


    }


		public function update(Request $request, $id)
		{	
			 $task = material::findOrFail($id);

			 $request = request();

			 $new_file = null;

	        if($request->file('upload_file')!=null)
	        {


	              $file = $request->file('upload_file');
	              $fileSaveAsName = time() . Auth::id() . "-file." .
	                                      $file->getClientOriginalExtension();

	              $upload_path = 'studymaterials/';

	              $new_file =  $fileSaveAsName;

	        }
	        

		      $this->validate($request, [
	          'title' => 'required',
	          'description' => 'required',
	          'subject' =>  'required',
	          'course'  => 'required',
	          

	           ]);	


		    

	           $data  = DB::table('materials')
		      		->where('id',$id)
		      		->update([ 

		      			'upload_file' => $new_file,
		      			'title' => $request->title,
		      			'description' => $request->description,
		      			'course' => $request->course,
		      			'subject' => $request->subject,
		      			'topic' => $request->topic,

		      		]);


		      	$path = public_path()."/studymaterials/".$task->upload_file;
		    if (File::exists($path)) {
			        File::delete($path);

		       }	

		        $file->move($upload_path, $fileSaveAsName);


        	 return response()->json
               ([
                   'success' =>  true,
                   

               ],200);


		}

	public function destroy($id)
		{
		    $task = material::findOrFail($id);
		    // dd($task);
		    // $filename = storage_path("studymaterials/{$task->upload_file}");

			   //  if (File::exists($filename)) {
			   //      File::delete($filename);
			   //      // unlink($image_path);
			   //  }

		    $path = public_path()."/studymaterials/".$task->upload_file;
		    if (File::exists($path)) {
			        File::delete($path);

		   }
		    $task->delete();


	//dd($task);
			 return response()->json
		           ([
		               'success' =>  true,
		               

		           ],200);

//return redirect()->route('api/teachers/Auth/teacherController');
}



		
}
