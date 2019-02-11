<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PasswordTest extends TestCase
{
    use RefreshDatabase;
    protected $user;

    public function setUp()
    {
        parent::setup();

        $this->user = factory('App\User')->create(['role' => 'user']);
    }

    /** @test */
    public function signed_in_user_can_see_change_password_page()
    {
        $this->actingAs($this->user);

        $response = $this->get('/change-password');
        
        $response->assertOk();
    }

    /** @test */
    public function signed_in_user_can_change_password()
    {
        $this->actingAs($this->user);

        $response = $this->post('/change-password', [
            'old_password' => 'secret',
            'new_password' => 'scandal'
        ]);

        $response = \Illuminate\Support\Facades\Hash::check('scandal', Auth()->user()->password);

        $this->assertTrue($response);
    }
}
