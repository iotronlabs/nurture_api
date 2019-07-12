<?php

namespace App\Http\Controllers\api\forum;

use App\Forum\Filters\ThreadFilters;
use App\Http\Controllers\Controller;
use App\Models\forum\forum_channel;
use App\Models\forum\forum_thread;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ThreadsController extends Controller
{
     public function __construct()
    {
      $this->middleware('auth_users');
     // $this->middleware('guest:user_teachers');
    }

    public function index(forum_channel $channel, ThreadFilters $filters)
    {
      // if($channelSlug)
      // {
        // $channelId = forum_channel::where('slug',$channelSlug)->first()->id;
        // $threads = forum_thread::where('channel_id',$channelId)->latest()->get();
      //   if ($channel->exists) {
      //   $threads = $channel->threads()->get();
      // }
      // // }
      // else
      // {
      //   $threads = forum_thread::latest()->get();
      // }

       $threads = $this->getThreads($channel, $filters);

      return response()->json
      ([
               'success' =>  true,
               'channel' => $channel,
               'data' => $threads,
               
        ],200);

    }
     public function show($channelSLug , forum_thread $thread)
    {

      $replies = $thread->replies()->get();

      return response()->json
      ([
               'success' =>  true,
               'data' => $thread,
               'reply' => $replies,
               
        ],200);

    }

    public function store(Request $request)
    {


     request()->validate([
            'title' => 'required',
            'body' => 'required',
            'channel_id' => 'required|exists:channels,id',
     ]);

    	$thread = forum_thread::create([
      
         'user_id' => request('user_id'),//$user->id,
         'title'  => request('title'),
         'body' => request('body'),
         'channel_id' => request('channel_id'),
         'slug' => request('slug'),
         't_ref_id' => request('t_ref_id'),
         't_authentication' => 1

    	]);

    	return redirect('/api/forum/threads');
    }


     protected function getThreads(forum_channel $channel, ThreadFilters $filters)
    {
        $threads = forum_thread::latest()->filter($filters);

        if ($channel->exists) {
            $threads->where('forum_channel_id', $channel->id);
        }

        return $threads->paginate(20);
    }

    
}    
