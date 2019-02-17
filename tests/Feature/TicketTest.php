<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TicketTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guest_cannot_see_full_description_of_an_event()
    {
        $this->get('/events/1')
            ->assertRedirect('login');
    }
    
    /** @test */
    // public function authenticated_user_can_see_full_description_of_an_event()
    // {
    //     $this->actingAs($user = factory('App\User')->create());

    //     $this->get('/events/1')
    //         ->assertRedirect('login');
    // }

}


