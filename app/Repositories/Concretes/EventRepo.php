<?php

namespace App\Repositories\Concretes;

use App\Event;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
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
        $result = Cache::remember('paginated_events_cache', 1440, function () use ($amount) {
            return Event::paginate($amount);
        });

        return $result;

    }

    public function getPaginatedActiveEvents(int $amount)
    {
        $result = Cache::remember('paginated_active_events_cache', 1440, function () use ($amount) {
            return Event::where('status', '=', 1)->orderBy('id', 'DESC')->paginate($amount);
        });

        return $result;
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
        return Event::count();
    }

    public function getEventsUploadedByUser(int $id)
    {
        return Event::where([
            ['user_id', '=', $id],
            ['status', '=', '1']
        ])->get();
    }

    public function getTotalEventsUploadedByUser(int $id)
    {
        return Event::where([
            ['user_id', '=', $id],
            ['status', '=', '1']
        ])->count();
    }

    public function getEventsUploadedByUserWithTheTickets()
    {
        return Auth::user()->events()->with('tickets')->get();
    }

    public function getLatestUploadedEvent()
    {
        return Event::latest()->first();
    }

    public function getEventsWithTickets()
    {
        return Event::with('tickets')->get();
    }

    public function getPaginatedActiveEventsWithTickets(int $amount)
    {
        $result = Cache::remember('paginated_active_events_with_tickets_cache', 1440, function () use ($amount) {
            return Event::with('tickets')->where('status', '=', 1)->orderBy('id', 'DESC')->paginate($amount);
        });

        return $result;
    }

    public function searchEvent(string $param, int $amount)
    {
        return Event::search($param)->paginate($amount);
    }

}