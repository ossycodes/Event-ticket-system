<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AboutPageTest extends TestCase
{
    public function testCanViewAboutPage()
    {
        $resp = $this->get('/aboutus');

        $resp->assertStatus(200);
        $resp->assertSee('Who We Are');
    }
}
