<?php

namespace App\Http\Controllers\api\forum;

use App\Http\Controllers\Controller;
use App\Models\forum\forum_thread;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class RepliesController extends Controller
{
    public function __construct()
    {
    	$this->middleware('guest:students');
    	$this->middleware('guest:user_teachers');
    }

    public function store($channelId , forum_thread $thread)
    {
      
       $user = Auth::user();

       $id = 0;
       // Auth::guard('students')->user()->s_id;
 
       if(Auth::guard('students')->check())
       {
       	 $user = Auth::guard('students')->user();

         $id = $user->s_id;
        
       }

        if(Auth::guard('user_teachers')->check())
       {
       	 $user = Auth::guard('user_teachers')->user();
//
          $id = $user->s_id;
       }

        request()->validate([
            'title' => 'required',
        ]);

        // dd($user);

      $thread->addReply([

       'body' => request('body'),
       'user_id' =>  $id, // request('user_id'), //to be changed  $user->id(),
       't_authentication' => 1,
       't_ref_id' =>  1 //request('t_ref_id')  //to be changed
    
      ]);

      return redirect('/api/forum/threads/'. $thread->id);
    }


}
