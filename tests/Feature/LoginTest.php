<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
   use RefreshDatabase;


    /**
     * @test
     */
    public function a_loggedin_user_should_not_be_able_to_see_the_login_page()
    {
        $user = factory('App\User')->create();
        
        $this->actingAs($user);

        $response = $this->get('/login');

        $response->assertRedirect('/home');
    }

    /**
     * @test
     */
    public function a_loggedin_user_should_not_be_able_to_see_the_register_page()
    {
        $user = factory('App\User')->create();
        $this->actingAs($user);

        $response = $this->get('/register');

        $response->assertRedirect('/home');
    }

    /**
     * @test
     */
    public function a_guest_should_not_be_able_to_login_in_with_invalid_credentials()
    {
        $credentials = [
            'email' => 'invalid@gmail.com',
            'password' => 'secret'
        ];
        
        $response = $this->post('/login', $credentials);

        $this->assertInvalidCredentials($credentials, $guard = null);
    }

    /**
     * @test
     */
    public function a_guest_should_be_able_to_login_with_valid_credentials()
    {
        $user = factory('App\User')->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'secret'
        ]);

        $response->assertStatus(302);
        $this->assertAuthenticatedAs($user);
    }

    /**
     * @test
     */
    public function a_loggedin_user_can_see_the_dashboard()
    {
        $user = factory('App\User')->create();
        $this->actingAs($user);

        $response = $this->get('/home');

        $response->assertOk();
    }

}
