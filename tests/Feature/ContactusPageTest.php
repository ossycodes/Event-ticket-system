<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContactusPageTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     */
    public function user_can_view_contact_us_page()
    {

        $this->withoutExceptionHandling();

        $resp = $this->get('/contactus');

        $resp->assertStatus(200);
        $resp->assertSee('CONTACT');
        $resp->assertSee('WE\'RE ALWAYS HERE TO HELP YOU');

    }

    /** 
     * @test
    */
    public function user_can_send_contact_us_message()
    {

        $attributes = [
            'name' => 'testname',
            'email' => 'test@gmail.com',
            'phonenumber' => '08027332873',
            'message' => 'testing hehee',
        ];

        $this->post('/contactus',$attributes);

        $this->assertDatabaseHas('contacts', $attributes);


    }

}
