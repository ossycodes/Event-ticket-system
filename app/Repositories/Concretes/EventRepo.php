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
        return Event::where('user_id', Auth::id())->with('tickets')->get();
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

    public function createEvent($data)
    {
        return Event::create([

            'user_id' => $data['user_id'],
            'category_id' => $data['category_id'],
            'image' => $data['image'],
            'public_id' => $data['public_id'],
            'name' => $data['name'],
            'venue' => $data['venue'],
            'description' => $data['description'],
            'actors' => $data['actors'],
            'time' => $data['time'],
            'date' => $data['date'],
            'age' => $data['age'],
            'dresscode' => $data['dresscode'],
            'quantity' => $data['quantity'] ?? '0'

        ]);
    }

    public function updateEvent($eventId, $data)
    {
        return Event::find($eventId)->update([

            'name' => $data['name'],
            'category_id' => $data['category_id'],
            'user_id' => Auth::user()->id,
            'venue' => $data['venue'],
            'description' => $data['description'],
            'date' => $data['date'],
            'time' => $data['time'],
            'actors' => $data['actors'],
            'age' => $data['age'],
            'dresscode' => $data['dresscode'],
            'image' => $data['image'],
            'public_id' => $data['public_id'],
            'quantity' => $data['quantity'],

        ]);
    }

    public function deleteEvent(int $eventId)
    {
        return Event::destroy($eventId);
    }

    public function deActivateEvent(int $eventId)
    {
        return Event::find($eventId)->update([
            'status' => 0
        ]);   
    }

    public function activateEvent(int $eventId)
    {
        return Event::find($eventId)->update([
            'status' => 1
        ]);
    }
}