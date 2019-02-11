<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminTest extends TestCase
{
    use RefreshDatabase;

    protected $adminUser;

    public function setUp()
    {
        parent::setup();

        $this->adminUser = factory('App\User')->create(['role' => 'admin']);
    }

    /** @test */
    public function admin_cannot_visit_user_routes()
    {
        $this->actingAs($this->adminUser);

        $this->get('/user/transactions')
            ->assertStatus(404);

        $this->get('/user/profile')
            ->assertStatus(404);

        $this->get('/user/events')
            ->assertStatus(404);

        $this->get('/user/change-password')
            ->assertStatus(404);

        $this->get('/user/read-notifications')
            ->assertStatus(404);

        $this->get("user/delete-account/{$this->adminUser->id}")
            ->assertStatus(404);

        $this->get("user/receipt/{$this->adminUser->id}")
            ->assertStatus(404);
    }

    /** @test */
    public function admin_should_see_homepage_specific_to_admin()
    {
        $this->actingAs($this->adminUser);

        $this->get('/home')
            ->assertSee('User Registered')
            ->assertSee('Newsletter Subscribers')
            ->assertSee('Contactus Query')
            ->assertSee('Categories')
            ->assertSee('All Transactions');
    }

    /** @test */
    public function admin_can_see_all_registered_users()
    {
        $users = factory('App\User', 3)->create(['role' => 'user']);

        $this->actingAs($this->adminUser);

        $response = $this->get('system-admin/admin/users');

        foreach ($users as $user) {
            $response->assertSee($user->email);
        }

    }
    /** @test */
    public function admin_can_visit_profile_page()
    {
        $this->actingAs($this->adminUser);

        $this->get('system-admin/admin/profile')
            ->assertOk()
            ->assertSee($this->adminUser->email)
            ->assertSee('admin dashboard');
    }

    /** @test */
    public function admin_see_created_categories()
    {
        $categories = factory('App\Category', 3)->create();

        $this->actingAs($this->adminUser);

        $response = $this->get('/system-admin/admin/categories');

        foreach ($categories as $category) {
            $response->assertSee($category->name);
        }
    }

    /** @test */
    public function admin_can_create_category()
    {
        $this->actingAs($this->adminUser);

        $attribute = [
            'name' => 'test category'
        ];

        $response = $this->post('/system-admin/admin/categories', $attribute);

        $this->assertDatabaseHas('categories', $attribute);

    }

    /** @test */
    public function admin_can_delete_category()
    {
        $this->actingAs($this->adminUser);

        $category = factory('App\Category')->create();

        $response = $this->delete("/system-admin/admin/categories/{$category->id}");

        $this->assertDatabaseMissing('categories', $category->toArray());

    }

    /** @test */
    public function admin_can_view_contactus_queries()
    {
        $contactusQueries = factory('App\Contact', 3)->create();

        $this->actingAs($this->adminUser);

        $response = $this->get('system-admin/admin/messages');

        foreach ($contactusQueries as $query) {
            $response->assertSee($query->name)
                ->assertSee($query->email)
                ->assertSee($query->phonenumber)
                ->assertSee($query->message);
        }
    }

    /** @test */
    public function admin_can_delete_contactus_queries()
    {
        $contactusQueries = factory('App\Contact')->create();

        $this->actingAs($this->adminUser);

        $response = $this->delete("system-admin/admin/messages/{$contactusQueries->id}");

        $this->assertDatabaseMissing('contacts', $contactusQueries->toArray());
    }

    /** @test */
    public function admin_can_view_newsletter_subscribers()
    {
        $this->actingAs($this->adminUser);

        $newsletterSubscribers = factory('App\Newsletter', 5)->create();

        $response = $this->get('/system-admin/admin/subscribers');

        foreach ($newsletterSubscribers as $subscriber) {
            $response->assertSee($subscriber->email);
        }
    }
}
