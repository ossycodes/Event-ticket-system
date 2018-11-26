<?php

namespace App\Http\Controllers;

use App\Event;

use validator;
use Illuminate\Http\Request;

class EventscommentController extends Controller
{
    public function store(Request $request)
    {

        Event::find(decrypt($request->event_id))->eventscomment()
            ->create($request->except('event_id'));

        return back()->with('success', 'Comment submitted, would be active after being reviewed, thank you.');
    }

}
