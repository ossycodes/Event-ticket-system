<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserProfileTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    public function setUp()
    {
        parent::setup();

        $this->user = factory('App\User')->create(['role' => 'user']);
    }
    /** @test */
    public function user_can_see_profile_page()
    {
        $this->actingAs($this->user);

        $response = $this->get('/user/profile');

        $response->assertStatus(200);
    }

    /** @test */
    public function phonenumber_is_required_to_update_profile()
    {
        $this->actingAs($this->user);

        $response = $this->put("/user/profile/{$this->user->id}", [
            'name' => $this->user->name,
            'email' => $this->user->email,
            'gender' => 'male',
            'education' => 'ispium',
            'location' => 'Ilorem',
            'skills' => 'php',
        ]);
        
        $response->assertSessionHas('errors');
        $response->assertSessionHasErrors('phonenumber');
    }


    /** @test */
    public function name_is_required_to_update_profile()
    {
        $this->actingAs($this->user);

        $response = $this->put("/user/profile/{$this->user->id}", [
            'email' => $this->user->email,
            'gender' => 'male',
            'education' => 'ispium',
            'location' => 'Ilorem',
            'skills' => 'php',
        ]);

        $response->assertSessionHas('errors');
        $response->assertSessionHasErrors('name');
    }

    /** @test */
    public function email_is_required_to_update_profile()
    {
        $this->actingAs($this->user);

        $response = $this->put("/user/profile/{$this->user->id}", [
            'name' => $this->user->name,
            'phonenumber' => '08027332272',
            'gender' => 'male',
            'education' => 'ispium',
            'location' => 'Ilorem',
            'skills' => 'php',
        ]);

        $response->assertSessionHas('errors');
        $response->assertSessionHasErrors('email');
    }

    /** @test */
    public function email_is_input_is_a_valid_email()
    {
        $this->actingAs($this->user);

        $response = $this->put("/user/profile/{$this->user->id}", [
            'name' => $this->user->name,
            'phonenumber' => '08027332272',
            'email' => 'ssss',
            'gender' => 'male',
            'education' => 'ispium',
            'location' => 'Ilorem',
            'skills' => 'php',
        ]);

        $response->assertSessionHas('errors');
        $response->assertSessionHasErrors('email');
    }

    /** @test */
    public function gender_is_required_to_update_profile()
    {
        $this->actingAs($this->user);

        $response = $this->put("/user/profile/{$this->user->id}", [
            'name' => $this->user->name,
            'phonenumber' => '08027332272',
            'email' => 'test@test.com',
            'education' => 'ispium',
            'location' => 'Ilorem',
            'skills' => 'php',
        ]);

        $response->assertSessionHas('errors');
        $response->assertSessionHasErrors('gender');
    }

    /** @test */
    public function gender_is_must_be_male_or_female()
    {
        $this->actingAs($this->user);

        $response = $this->put("/user/profile/{$this->user->id}", [
            'name' => $this->user->name,
            'phonenumber' => '08027332272',
            'gender' => 'she male',
            'email' => 'test@test.com',
            'education' => 'ispium',
            'location' => 'Ilorem',
            'skills' => 'php',
        ]);

        $response->assertSessionHas('errors');
        $response->assertSessionHasErrors('gender');
    }

    /** @test */
    public function phonenumber_must_be_11_digits()
    {
        $user = factory('App\User')->create(['role' => 'user']);
        $this->actingAs($user);

        $response = $this->put("/user/profile/{$user->id}", [
            'name' => $user->name,
            'email' => $user->email,
            'phonenumber' => '08027332',
            'gender' => 'male',
            'education' => 'ispium',
            'location' => 'Ilorem',
            'skills' => 'php',
        ]);

        $response->assertSessionHas('errors');
        $response->assertSessionHasErrors('phonenumber');
    }

    /** @test */
    public function user_can_update_profile_information()
    {
        $user = factory('App\User')->create(['role' => 'user']);
        $this->actingAs($user);

        $response = $this->put("/user/profile/{$user->id}", [
            'name' => $user->name,
            'email' => $user->email,
            'phonenumber' => '08027332272',
            'gender' => 'male',
            'education' => 'ispium',
            'location' => 'Ilorem',
            'skills' => 'php',
        ]);

        $response->assertSessionHas('success', 'Profile updated successfully');
    }
}
