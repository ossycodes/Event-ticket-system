<?php

namespace App\Repositories\Concretes;

use App\Event;
use App\Repositories\Contracts\EventRepoInterface;


class EventRepo implements EventRepoInterface
{
    public function getPaginatedEvents(int $amount)
    {
        return Event::paginate($amount);
    }

    public function getPaginatedActiveEvents(int $amount)
    {
        return Event::where('status', '=', 1)->orderBy('id', 'DESC')->paginate($amount);    
    }
    
}