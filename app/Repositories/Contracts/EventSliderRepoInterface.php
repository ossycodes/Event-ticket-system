<?php

namespace App\Repositories\Contracts;

interface EventSliderRepoInterface
{
    public function getTotalSliders();

    public function getSlidersInDescendingOrder();
}