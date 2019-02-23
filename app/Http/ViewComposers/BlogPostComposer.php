<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Repositories\Contracts\BlogRepoInterface;

class BlogPostComposer
{
    public function __construct(BlogRepoInterface $blogRepo)
    {
        $this->blogRepo = $blogRepo;
    }

    public function compose(View $view)
    {
        $allPosts = $this->blogRepo->getPaginatedBlogPosts(6);
        $view->with(compact('allPosts'));
    }
}
