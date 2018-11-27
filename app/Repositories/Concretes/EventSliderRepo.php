<?php

namespace App\Repositories\Concretes;

use App\Eventsliderimages;
use App\Repositories\Contracts\EventSliderRepoInterface;


class EventSliderRepo implements EventSliderRepoInterface
{
    public function getTotalSliders()
    {
        return EventsliderImages::count();
    }

    public function getSlidersInDescendingOrder()
    {
        return Eventsliderimages::orderBy('id', 'desc')->get();
    }
}