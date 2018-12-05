<?php

namespace App\Repositories\Concretes;

use App\Eventsliderimages;
use App\Repositories\Contracts\EventSliderRepoInterface;

use Illuminate\Support\Facades\Cache;


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

    public function getEventImageSliders(int $amount)
    {
        $result = Cache::remember('slider_images_cache', 1440, function () use($amount) {
            return Eventsliderimages::select('slider_imagename')->paginate($amount);
        });
        
        return $result;
    }
}