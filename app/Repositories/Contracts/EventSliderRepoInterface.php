<?php

namespace App\Repositories\Contracts;

interface EventSliderRepoInterface
{
    public function getTotalSliders();

    public function getSlidersInDescendingOrder();

    public function getEventImageSliders(int $id);
}