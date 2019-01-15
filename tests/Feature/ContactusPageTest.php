<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContactusPageTest extends TestCase
{
    /**
     * @group view-contactuspage
     */
    public function testCanViewContactUsPage()
    {
        $resp = $this->get('/contactus');

        $resp->assertStatus(200);
        $resp->assertSee('CONTACT');
        $resp->assertSee('WE\'RE ALWAYS HERE TO HELP YOU');

    }
}
