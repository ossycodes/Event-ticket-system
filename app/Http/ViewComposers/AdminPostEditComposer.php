<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Helper\returnIdFromRequestSegment;
use App\Repositories\Contracts\BlogRepoInterface;

class AdminPostEditComposer
{
    use returnIdFromRequestSegment;
    
    protected $blogRepo;

    public function __construct(BlogRepoInterface $blogRepo)
    {
        $this->blogRepo = $blogRepo;
    }
    
    public function compose(View $view)
    {
        $id = (int) $this->returnIdFromRequestSegment(4);
        $post = $this->blogRepo->getBlog($id);
        $postImage = $this->blogRepo->getBlogImage($id);
        $blogImage = $this->blogRepo->getImageForBlogPost($id);
        $view->with(compact('post', 'postImage', 'blogImage'));
    }

}