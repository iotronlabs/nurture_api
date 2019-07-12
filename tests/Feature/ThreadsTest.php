<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ThreadsTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_a_user_can_view_threads()
    {
        $thread = factory('App\Models\forum\forum_thread')->create();

        $response = $this->get('/api/forum/threads');

        $response->assertSee($thread->title);
    }

    public function test_a_user_can_read_a_single_thread()
    {
        $thread = factory('App\Models\forum\forum_thread')->create();

        $this->get($thread->path())
            ->assertSee($thread->title);
    }
 
    public function test_a_user_can_see_replies_associated_with_threads()
    {

        $thread = factory('App\Models\forum\forum_thread')->create();

        $reply = factory('App\Models\forum\forum_reply')->create(['forum_thread_id' => $thread->id]);

        $response = $this->json('get','/api/forum/threads/'.$thread->id);

         
        $response->assertJson([
               'success' =>  true,
             ]);

    } 
 
}
