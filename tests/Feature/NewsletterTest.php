<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class NewsletterTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_see_the_newsletter_subscription_form()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Subscribe');
        $response->assertSee('to');
        $response->assertSee('our Newsletter');

    }

    /** @test */
    public function user_can_subscribe_to_newsletter()
    {
        $resp = $this->post('/newsletter', [
            'email' => 'test@gmail.com'
        ]);
        
        $this->assertDatabaseHas('newsletters', [
            'email' => 'test@gmail.com'
        ]);
    }
}
