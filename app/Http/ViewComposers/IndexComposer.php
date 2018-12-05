<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Eventsliderimages;
use Illuminate\Support\Facades\Cache;
use App\Repositories\Concretes\EventSliderRepo;

class IndexComposer

{

    protected $eventRepo;

    public function __construct(EventSliderRepo $eventRepo)
    {
        $this->eventRepo = $eventRepo;
    }

    public function compose(View $view)
    {
        $eventImages = $this->eventRepo->getEventImageSliders(6);
        $view->with('eventSliderImages', $eventImages);
    }
}