<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CommentTest extends TestCase
{
    /** @test */
    public function authenticated_user_can_comment_on_post()
    {
        $this->actingAs($user = factory('App\User')->create());
        //create factory for event kai!
    }
}
