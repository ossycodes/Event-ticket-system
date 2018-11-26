<?php

namespace App\Repositories\Concretes;

use App\Blog;
use App\Repositories\Contracts\BlogRepoInterface;


class BlogRepo implements BlogRepoInterface
{
    public function getAllBlogPosts()
    {
        return Blog::all();
    }

    public function getPaginatedBlogPosts(int $amount)
    {
        return Blog::paginate($amount);
    }

    public function getTotalEvents()
    {
        return Blog::all()->count();   
    }
}