<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CommentTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function authenticated_user_can_comment_on_post()
    {
        $this->actingAs($user = factory('App\User')->create());
        $event = factory('App\Event')->create();
        $comment = [
            "name" => $user->name,
            "email" => $user->email,
            "message" => "nice post",
            "event_id" => encrypt($event->id)
        ];
        
        //check on this at midnight using night plan
        $resp = $this->post("/events/{$event->id}/comments", $comment);

        $resp->assertSessionHas('success');
        $this->assertDatabaseHas('eventscomments', $comment);
    }

    /** @test */
    // public function admin_can_activate_a_comment()
    // {
            //verify this test
    //     //whip up an event
    //     $comment = factory('App\Eventscomment')->create();
    //     $this->actingAs($user = factory('App\User')->create([
    //         'role' => 'admin'
    //     ]));

    //     $resp = $this->post("system-admin/admin/activate-comment/{$comment->id}");

    //     $resp->assertSessionHas('success', 'Comment successfully activated');

    //     $this->assertDatabaseHas('eventscomments', [
                    // 'name' => $comment->name,
                    // 'email' => $comment->email,
                    // 'message' => $comment->message,
                    // 'status' => 1,
                    // 'event_id' => $comment->event()->id
    //      ])

    // }

    /** @test */
    // public function admin_can_de_activate_a_comment()
    // {
        //verify this test
    //     $comment = factory('App\Eventscomment')->create([
    //         'status' => 1
    //     ]);
    //     $this->actingAs($user = factory('App\User')->create([
    //         'role' => 'admin'
    //     ]));

    //     $resp = $this->post("system-admin/admin/de-activate-comment/{$comment->id}");

    //     $resp->assertSessionHas('success', 'Comment successfully de-activated');

    // //     $this->assertDatabaseHas('eventscomments', [
    //             // 'name' => $comment->name,
    //             // 'email' => $comment->email,
    //             // 'message' => $comment->message,
    //             // 'status' => 0,
    //             // 'event_id' => $comment->event()->id
    // //     ])
    // }

    /** @test */
    // public function admin_can_delete_a_comment()
    // {
        //verify this
    //     $comment = factory('App\Eventscomment')->create();
    //     $resp = $this->post("system-admin/admin/delete-comment/{$comment->id}");

    //     $resp->assertSessionHas('success', 'Comment deleted successfully');
    //     $this->assertDatabaseMissing('eventscomment', [
    //         'name' => $comment->name,
    //         'email' => $comment->email,
    //         'message' => $comment->message,
    //         'status' => 0,
    //         'event_id' => $comment->event()->id
    //     ]);
    // }
}
