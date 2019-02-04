<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guest_can_see_registeration_page()
    {
        
        $response = $this->get('/register');
        
        $response->assertStatus(200);
        
    }

    /** @test */
    public function name_required_for_registeration() {
        
        $attributes = [
            'email' => 'test@gmail.com',
            'password' => 'secret',
            'password_confirmation' => 'secret',
        ];

        $response = $this->post('/register', $attributes);

        $response->assertSessionHasErrors(['name']);
    }

    /** @test */
    public function email_required_for_registeration() {
        
        $attributes = [
            'name' => 'test',
            'password' => 'secret',
            'password_confirmation' => 'secret',
        ];

        $response = $this->post('/register', $attributes);

        $response->assertSessionHasErrors(['email']);
    }

    /** @test */
    public function password_required_for_registeration() {
        
        $attributes = [
            'name' => 'test',
            'email' => 'test@test.com',
            'password_confirmation' => 'secret',
        ];

        $response = $this->post('/register', $attributes);

        $response->assertSessionHasErrors(['password']);
    }

     /** @test */
     public function password_match_required_for_registeration() {
        
        $attributes = [
            'name' => 'test',
            'email' => 'test@test.com',
            'password' => 'secret',
        ];

        $response = $this->post('/register', $attributes);

        $response->assertSessionHasErrors(['password']);
    }

    /** @test */
    public function guest_can_register()
    {
        $this->withoutExceptionHandling();

        $attributes = [
            'name' => 'test',
            'email' => 'test@gmail.com',
            'password' => 'secret',
            'password_confirmation' => 'secret',
        ];

        $response = $this->post('/register', $attributes);
        
        $response->assertRedirect('/home');

        $this->assertDatabaseHas('users', [
            'name' => 'test',
            'email' => 'test@gmail.com',
            'role' => 'user'
        ]);
        
    }

}
