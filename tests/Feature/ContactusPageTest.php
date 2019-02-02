<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContactusPageTest extends TestCase
{
    use RefreshDatabase;
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
    
    public function testCanSendAcontactUsMessage() {

        $attributes = [
            'name' => 'testname',
            'email' => 'test@gmail.com',
            'phonenmuber' => '08027332873',
            'message' => 'testing hehee'
        ];

        $resp = $this->post('/contactus', $attributes);
            $resp->assertSessionHas('success'); 

         
    }
}
