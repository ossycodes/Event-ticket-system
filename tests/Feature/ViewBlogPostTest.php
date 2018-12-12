<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ViewBlogPostTest extends TestCase
{
    /**
     * @group create-post
     */
    public function testCanViewBlogPost()
    {
       $blogPost = \App\Blog::create([
            'title' => 'simple test',
            'description' => 'A basic test',
            'body' => 'body of test'
        ]);
        
        $resp = $this->get("/posts/{$blogPost->id}");

        $resp->assertStatus(200);
        $resp->assertSee($blogPost->title);
        $resp->assertSee($blogPost->body);
        $resp->assertSee($blogPost->description);
    }

    /**
     * @group post-not-found
     */
    public function testViews404PageWhenBlogPostIsNotFound() 
    {
        $invalid_id = 500;
        $resp = $this->get("/posts/{$invalid_id}");

        $resp->assertSee('404');
        $resp->assertStatus(404);
    }
}
