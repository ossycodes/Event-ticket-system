<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

use App \{
    Event,
        Category,
        Background
};  //php7 grouping use statements

use App\Repositories\Contracts \{
    EventRepoInterface,
        CategoryRepoInterface
};
use App\Services\RedisService;  //php7 grouping use statements



class IndexController extends Controller
{
    protected $categoryRepo;
    protected $eventRepo;
    protected $path = 'images/frontend_images/events/';
    protected $redisService;

    //constructor dependency injection of CategoryRepoInterface
    public function __construct(CategoryRepoInterface $categoryRepo, EventRepoInterface $eventRepo, RedisService $redisService)
    {
        $this->categoryRepo = $categoryRepo;
        $this->eventRepo = $eventRepo;
        $this->redisService = $redisService;
    }

    public function showIndexPage(Request $request)
    {
        $this->redisService->storeIpAddressOfSiteVisitors($request);

        $allCategories = $this->categoryRepo->getAllCategories();
        $noofeventsimages = $this->eventRepo->getPaginatedEvents(6);
        $events = $this->eventRepo->getPaginatedActiveEvents(3);

        return view('index', compact('events', 'noofeventsimages', 'allCategories'));
    }

    public function showAboutusPage()
    {
        return view('aboutus');
    }

}
