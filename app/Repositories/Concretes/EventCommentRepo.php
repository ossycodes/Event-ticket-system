<?php

namespace App\Repositories\Concretes;

use App\Event;
use App\Eventscomment;
use Illuminate\Http\Request;
use App\Repositories\Contracts\EventCommentRepoInterface;


class EventCommentRepo implements EventCommentRepoInterface
{
    public function totalNumberOfComments(int $id, int $status)
    {
        return Eventscomment::where([
            ['event_id', '=', $id],
            ['status', '=', $status]
        ])->count();
    }
    
    public function addCommentForEvent(Request $request)
    {
        Event::find(decrypt($request->event_id))->eventscomment()
            ->create($request->except('event_id'));
    }
    
    public function getLatestComment()
    {
        return Eventscomment::latest()->first();
    }

    public function getCommentsForEvent(int $id)
    {
        return Eventscomment::where('event_id', '=', $id)->get();
    }

    public function getTotalComments()
    {
        return EventsComment::count();
    }
}