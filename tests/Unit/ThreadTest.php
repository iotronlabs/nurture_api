<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ThreadTest extends TestCase
{
   use RefreshDatabase;

    public function test_a_thread_has_replies()
    {
        
        $thread = factory('App\Models\forum\forum_thread')->create();
        
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $thread->replies);
    }

    public function test_a_thread_have_creator()
    {

        $thread = factory('App\Models\forum\forum_thread')->create();

        $this->assertInstanceOf('App\Models\teacher\user_teacher', $thread->creator);

    }

    public function test_a_thread_can_add_a_reply()
    {
        $thread = factory('App\Models\forum\forum_thread')->create();

        $thread->addReply([

            'body' => 'Foobar',
            'user_id' => 1,
            't_authentication' => 1 ,
            't_ref_id' => 1

        ]);

        $this->assertCount(1, $thread->replies);
    }

}
