<?php

namespace App\Repositories\Concretes;

use App\Blog;
use App\Blogsimage;
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

    public function getTotalBlogPosts()
    {
        return Blog::all()->count();
    }

    public function getBlog(int $id)
    {
        return Blog::findOrFail($id);
    }

    public function getBlogComments(int $id)
    {
        return Blog::findOrFail($id)->postcomments;
    }

    public function getBlogImage(int $id)
    {
        return Blog::findOrFail($id)->blogimage;
    }

    public function getImageForBlogPost(int $id)
    {
        return Blogsimage::where('blog_id', '=', $id)->first();
    }

    public function getCommentsForBlogPostDescendingOrder()
    {
        return Blog::with(['postcomments' => function ($query) {
            $query->orderBy('created_at', 'desc');
        }])->get();
    }

}