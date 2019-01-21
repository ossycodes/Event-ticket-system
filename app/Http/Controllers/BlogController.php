<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\{
    Blog, 
    Event,
    Postscomment
}; //php7 grouping use statements

use App\Repositories\Contracts\BlogRepoInterface;
use App\Services\RedisService;

class BlogController extends Controller
{
    protected $blogRepo;
    protected $redisService;

    public function __construct(BlogRepoInterface $blogRepo, RedisService $redisService)
    {
        $this->blogRepo = $blogRepo;
        $this->redisService = $redisService;
    }

    public function __invoke(Request $request, $id)
    {
        $this->redisService->storeBlogPageViews($request);

        $postDetails = $this->blogRepo->getBlog($id);
        $postComments = $this->blogRepo->getBlogComments($id);
        $postImage = $this->blogRepo->getBlogImage($id);

        return view('post', compact('postDetails', 'postComments', 'postImage'));
    }
}
