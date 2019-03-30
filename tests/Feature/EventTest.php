<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EventTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guest_cannot_see_full_description_of_an_event()
    {
        $this->get('/events/1')
            ->assertRedirect('login');
    }
    
    /** @test */
    public function authenticated_user_can_see_full_description_of_an_event()
    {
        $this->actingAs($user = factory('App\User')->create());
        $event = factory('App\Event')->create();
        $this->get("/events/{$event->id}")
            ->assertSee($event->$event['name'])
            ->assertSee($event->$event['description']);
    }

    /** @test */
    // public function admin_can_activate_an_event()
    // {
        //verify this
    //     $event = factory('App\Event')->create();
    //     $resp = $this->post("admin/activate/{$event->id}");

    //     $resp->assertSessionHas('success', 'Event successfully activated');

    //     $this->assertDatabaseHas('events', $event->toArray());
    // }
    
    /** @test */
    // public function admin_can_de_activate_an_event()
    // {
      //verify this
        //     $event = factory('App\Event')->create([
        //     'status' => 1
        // ]);
        //     $resp = $this->post("admin/de-activate/{$event->id}");

        //     $resp->assertSessionHas('success', 'Event successfully De-activated');

        //     $this->assertDatabaseHas('events', $event->toArray());

    // }
}
