<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;

use App\Helper\returnIdFromRequestSegment;
use App\Repositories\Contracts\BlogRepoInterface;

class PostComposer
{
    use returnIdFromRequestSegment;

    protected $blogRepo;

    public function __construct(BlogRepoInterface $blogRepo)
    {
        $this->blogRepo = $blogRepo;
    }

    public function compose(View $view)
    {   
        $id = $this->returnIdFromRequestSegment();
        
        $postDetails = $this->blogRepo->getBlog($id);
        $postComments = $this->blogRepo->getBlogComments($id);
        $postImage = $this->blogRepo->getBlogImage($id);

        $view->with(compact('postDetails', 'postComments', 'postImage'));
    }

}