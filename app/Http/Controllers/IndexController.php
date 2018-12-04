<?php

namespace App\Http\Controllers;

use App\Event;
use App\Category;
use App\Background;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\Repositories\Contracts\EventRepoInterface;
use App\Repositories\Contracts\CategoryRepoInterface;


class IndexController extends Controller
{
    protected $categoryRepo;
    protected $eventRepo;
    protected $path = 'images/frontend_images/events/';

    //constructor dependency injection of CategoryRepoInterface
    public function __construct(CategoryRepoInterface $categoryRepo, EventRepoInterface $eventRepo)
    {
        $this->categoryRepo = $categoryRepo;
        $this->eventRepo = $eventRepo;
    }

    //use __invoke() since i have only one method in this controller.
    public function __invoke()
    {
        $allCategories = $this->categoryRepo->getAllCategories();
        $noofeventsimages = $this->eventRepo->getPaginatedEvents(6);
        $events = $this->eventRepo->getPaginatedActiveEvents(3);
       
        return view('index', compact('events', 'backgroundInfo', 'noofeventsimages', 'allCategories'));
    }

}
