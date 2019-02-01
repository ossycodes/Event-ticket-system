<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Eventsliderimages;
use Illuminate\Support\Facades\Cache;
use App\Repositories\Concretes\EventRepo;
use App\Repositories\Concretes\EventSliderRepo;
use App\Repositories\Contracts\EventRepoInterface;
use App\Repositories\Contracts\CategoryRepoInterface;

class IndexComposer

{

    protected $categoryRepo;
    protected $eventRepo;
    protected $eventSliderRepo;

    public function __construct(CategoryRepoInterface $categoryRepo, EventSliderRepo $eventSliderRepo, EventRepoInterface $eventRepo)
    {
        $this->categoryRepo = $categoryRepo;
        $this->eventSliderRepo = $eventSliderRepo;
        $this->eventRepo = $eventRepo;
    }

    public function compose(View $view)
    {
        $allCategories = $this->categoryRepo->getAllCategories();
        $noofeventsimages = $this->eventRepo->getPaginatedEvents(6);
        $eventSliderImages = $this->eventSliderRepo->getEventImageSliders(6);
        $events = $this->eventRepo->getPaginatedActiveEvents(3);
        $view->with(compact('eventSliderImages', 'noofeventsimages', 'allCategories', 'events'));
    }
}