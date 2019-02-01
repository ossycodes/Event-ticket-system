<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;

use App\Repositories\Contracts \{
    EventRepoInterface,
    BlogRepoInterface,
    CategoryRepoInterface
}; //php7 grouping use statements

use App\Helper\returnIdFromRequestSegment;

class EventViaCategoryComposer
{
    use returnIdFromRequestSegment;

    public function __construct(EventRepoInterface $eventRepo, BlogRepoInterface $blogRepo, CategoryRepoInterface $categoryRepo)
    {
        $this->eventRepo = $eventRepo;
        $this->blogRepo = $blogRepo;
        $this->categoryRepo = $categoryRepo;
    }

    public function compose(View $view)
    {
        $id = $this->returnIdFromRequestSegment();
        
        $eventsimage = $this->eventRepo->getPaginatedEvents(6);
        $allBlogPosts1 = $this->blogRepo->getPaginatedBlogPosts(6);
        $categoryDetails = $this->categoryRepo->getCategoryWithEvent($id);
        $maximumId = $this->categoryRepo->getTotalCategories();
        $allCategories = $this->categoryRepo->getAllCategories();

        $view->with(compact('categoryDetails', 'eventsimage', 'allCategories', 'maximumId', 'allBlogPosts1'));

    }

}
