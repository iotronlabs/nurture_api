<?php

namespace App\Http\Controllers\api\forum;

use App\Http\Controllers\Controller;
use App\Models\forum\forum_channel;
use Illuminate\Http\Request;

class ChannelsController extends Controller
{
     public function index()
    {

      $channels = forum_channel::latest()->get();

      return response()->json
      ([
               'success' =>  true,
               'data' => $channels,
               
        ],200);

    }

    public function show(forum_channel $channel)
    {

      $threads = $channel->threads()->get();

      return response()->json
      ([
               'success' =>  true,
               'data' => $channel,
               'reply' => $threads,
               
        ],200);

    }
}
