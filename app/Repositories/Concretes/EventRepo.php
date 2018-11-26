<?php

namespace App\Repositories\Concretes;

use App\Event;
use App\Repositories\Contracts\EventRepoInterface;
use App\Repositories\Contracts\EventCommentRepoInterface;


class EventRepo implements EventRepoInterface
{
    public function getAllEvents()
    {
        return Event::all();
    }

    public function getPaginatedEvents(int $amount)
    {
        return Event::paginate($amount);
    }

    public function getPaginatedActiveEvents(int $amount)
    {
        return Event::where('status', '=', 1)->orderBy('id', 'DESC')->paginate($amount);
    }

    public function getEvent(int $id)
    {
        return Event::findOrFail($id);;
    }

    public function getPaginatedEventsDescendingOrder(int $amount)
    {
        return Event::orderBy('id', 'DESC')->paginate($amount);
    }

    public function getEventWithComments(int $id)
    {
        return Event::findOrFail($id)->eventscomment;
    }

    public function getTotalEvents()
    {
        return Event::all()->count();
    }

}