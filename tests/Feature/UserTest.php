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

        $response = $this->get('/home')
            ->assertDontSee('Posts')
            ->assertDontSee('User Registered')
            ->assertDontSee('Newsletter Subscribers')
            ->assertDontSee('Contactus Query')
            ->assertDontSee('Categories')
            ->assertDontSee('All Transactions');

    }

    /** @test */
    public function a_signed_in_user_can_see_user_specific_links_on_homepage()
    {
        $this->actingAs($this->user);

        $response = $this->get('/home')
            ->assertSee('Book Event')
            ->assertSee('Upload Event')
            ->assertSee('View Profile')
            ->assertSee('Transactions');
    }

    /** @test */
    public function user_can_delete_account()
    {
        $this->actingAs($this->user);

        $response = $this->get("/user/delete-account/{$this->user->id}");

        $response->assertSessionHas('success')
            ->assertStatus(302);

    }

}
