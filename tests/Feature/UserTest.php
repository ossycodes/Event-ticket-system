<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    public function setUp()
    {
        parent::setup();

        $this->user = factory('App\User')->create(['role' => 'user']);
    }

    /** @test */
    public function a_registered_user_cannot_visit_admin_protected_route()
    {
        $this->actingAs($this->user);

        $response = $this->get('/system-admin/admin');

        $response->assertStatus(404);
    }

    /** @test */
    public function a_signed_in_user_cannot_see_admin_specific_links_on_homepage()
    {
        $this->actingAs($this->user);

        $response = $this->get('/home');
        $response->assertDontSee('Posts');
        $response->assertDontSee('User Registered');
        $response->assertDontSee('Newsletter Subscribers');
        $response->assertDontSee('Contactus Query');
        $response->assertDontSee('Categories');
        $response->assertDontSee('All Transactions');

    }

    /** @test */
    public function a_signed_in_user_can_see_user_specific_links_on_homepage()
    {
        $this->actingAs($this->user);

        $response = $this->get('/home');
        $response->assertSee('Book Event');
        $response->assertSee('Upload Event');
        $response->assertSee('View Profile');
        $response->assertSee('Transactions');

    }
    
}
