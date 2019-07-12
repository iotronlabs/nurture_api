<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PaticipateInForumTest extends TestCase
{
     use RefreshDatabase;
   
    public function test_an_authenticated_user_may_participate_in_threads()
    {

     
      
      $user = factory('App\Models\teacher\user_teacher')->create();

      $this->be($user);

      $thread = factory('App\Models\forum\forum_thread')->create(['user_id' => $user->t_id]);

      $reply = factory('App\Models\forum\forum_reply')->create(['forum_thread_id' => $thread->id , 'user_id' => $user->t_id]);

      $this->post('/api/forum/threads/'.$thread->id.'/replies',$reply->toArray());

      //dd($user,$thread,$reply);

      $this->get('/api/forum/threads/'.$thread->id)
           ->assertStatus(200);

    }
}
