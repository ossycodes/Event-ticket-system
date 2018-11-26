<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Blog;
use App\Event;
use App\Postscomment;
use App\Repositories\Contracts\BlogRepoInterface;

class BlogController extends Controller
{
    public function __construct(BlogRepoInterface $blogRepo)
    {
        $this->blogRepo = $blogRepo;
    }

    public function __invoke($id)
    {
        $postDetails = $this->blogRepo->getBlog($id);
        $postComments = $this->blogRepo->getBlogComments($id);
        $postImage = $this->blogRepo->getBlogImage($id);

        return view('post', compact('postDetails', 'postComments', 'postImage'));
    }
}
