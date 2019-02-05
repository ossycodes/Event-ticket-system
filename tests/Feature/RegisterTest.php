<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Mail\registeredUser;
use Illuminate\Support\Facades\Mail;
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
    public function name_required_for_registeration()
    {

        $attributes = [
            'email' => 'test@gmail.com',
            'password' => 'secret',
            'password_confirmation' => 'secret',
        ];

        $response = $this->post('/register', $attributes);

        $response->assertSessionHasErrors(['name']);
    }

    /** @test */
    public function email_required_for_registeration()
    {

        $attributes = [
            'name' => 'test',
            'password' => 'secret',
            'password_confirmation' => 'secret',
        ];

        $response = $this->post('/register', $attributes);

        $response->assertSessionHasErrors(['email']);
    }

    /** @test */
    public function password_required_for_registeration()
    {

        $attributes = [
            'name' => 'test',
            'email' => 'test@test.com',
            'password_confirmation' => 'secret',
        ];

        $response = $this->post('/register', $attributes);

        $response->assertSessionHasErrors(['password']);
    }

    /** @test */
    public function password_match_required_for_registeration()
    {

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

    /** @test */
    public function user_profile_is_set_to_null_after_registeration()
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

        $this->assertDatabaseHas('profiles', [
            'user_id' => 1,
            'gender' => '',
            'education' => '',
            'skills' => '',
            'location' => '',
        ]);
    }

    /** @test */
    public function guest_is_sent_a_mail_after_registeration_and_mail_is_queued()
    {
        Mail::fake();

        $user = [
            'name' => 'test',
            'email' => 'test@gmail.com',
            'password' => 'secret',
            'password_confirmation' => 'secret',
        ];

        $response = $this->post('/register', $user);
       
        Mail::assertQueued(registeredUser::class, 1);
        Mail::assertQueued(registeredUser::class, function ($mail) use ($user) {
            return $mail->user->email === $user['email'];
        });

        //to make this test pass, you have to remove implements queue in registeredUser class
        // Mail::assertSent(registeredUser::class, function ($mail) use ($user) {
        //     return $mail->hasTo($user['email']);
        // });
    }
}
