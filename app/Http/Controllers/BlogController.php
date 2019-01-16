<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\{
    Blog, 
    Event,
    Postscomment
}; //php7 grouping use statements

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
        dd($postDetails->image_name);
        $postComments = $this->blogRepo->getBlogComments($id);
        $postImage = $this->blogRepo->getBlogImage($id);

        return view('post', compact('postDetails', 'postComments', 'postImage'));
    }
}
