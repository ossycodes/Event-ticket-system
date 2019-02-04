<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AboutPageTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     */
    public function user_can_view_about_us_page()
    {
        
        $resp = $this->get('/aboutus');

        $resp->assertStatus(200);
        $resp->assertSee('Who We Are');
    }
}
