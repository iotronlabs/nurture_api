<?php

namespace App\Http\Controllers\api\forum;

use App\Http\Controllers\Controller;
use App\Models\forum\forum_reply;
use App\Models\forum\forum_save;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SavedController extends Controller
{
    
	public function __construct()
	{
     
      //$this->middleware('auth_users');
     
	}

    public function store(forum_reply $reply)
    {
      
     // if(! $reply->saves()->where(['user_id' => auth()->id])->exists())
     // // { 	
         $reply->saves()->create([
       
         'user_id' => mt_rand(1000,2500),//Auth::guard('students')->user()->s_id,
        
         ]);


         return $reply->load('saves');
         

     // }   

       // if( $reply->saves()->where(['user_id' => 1912])->exists())
       // {
           
       //     $data = forum_save::where(['user_id' => 1912 , 'saved_id' => $reply->id]);

       //     //dd($data);

       //     $data->delete();

       // }  

    }
}
