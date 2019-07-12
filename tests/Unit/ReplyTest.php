<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReplyTest extends TestCase
{ 
   use RefreshDatabase;

    public function test_it_has_an_owner()
    {
        $reply = factory('App\Models\forum\forum_reply')->create();

        $this->assertInstanceOf('App\Models\teacher\user_teacher', $reply->owner);
    }
}
