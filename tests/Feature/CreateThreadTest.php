<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateThreadTest extends TestCase
{
     use RefreshDatabase;

    public function test_an_authenticated_user_may_create_threads()
    {
        $user = factory('App\Models\teacher\user_teacher')->create();

        $this->be($user);

        $thread = factory('App\Models\forum\forum_thread')->create(['user_id' => $user->t_id]);

        $this->post('/api/forum/threads',$thread->toArray());

       // dd($thread);
  
        $this->get('/api/forum/threads'.$thread->id)
            ->assertSee($thread->title);
    }
}
