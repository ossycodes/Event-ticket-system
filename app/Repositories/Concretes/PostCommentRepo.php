<?php

namespace App\Repositories\Concretes;

use App\Postscomment;
use App\Repositories\Contracts\PostCommentInterface;


class PostCommentRepo implements PostCommentInterface
{   
    public function getLatestBlogPostComment()
    {
        return Postscomment::latest()->first();
    }
}