<?php

namespace App\Http\Controllers;

use App\Blog;
use App\Event;
use App\Category;
use Illuminate\Http\Request;
use App\Repositories\Contracts\EventRepoInterface;
use App\Repositories\Contracts\BlogRepoInterface;
use App\Repositories\Contracts\CategoryRepoInterface;

class CategoryController extends Controller
{
    protected $eventRepo;
    protected $blogRepo;
    protected $categoryRepo;

    public function __construct(EventRepoInterface $eventRepo, BlogRepoInterface $blogRepo, CategoryRepoInterface $categoryRepo)
    {
        $this->eventRepo = $eventRepo;
        $this->blogRepo = $blogRepo;
        $this->categoryRepo = $categoryRepo;
    }
    //used __invoke since i have just a single method in this controller
    public function __invoke($id)
    {

        $eventsimage = $this->eventRepo->getPaginatedEvents(6);
        $allBlogPosts1 = $this->blogRepo->getPaginatedBlogPosts(6);
        $categoryDetails = $this->categoryRepo->getCategoryWithEvent($id);
        $maximumId = $this->categoryRepo->getTotalCategories();
        $allCategories = $this->categoryRepo->getAllCategories();
        return view('events.eventviacategory')->with(compact('categoryDetails', 'eventsimage', 'allCategories', 'maximumId', 'allBlogPosts1'));

    }

}
