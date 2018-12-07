<?php

namespace App\Http\Controllers;

use App\Event;
use validator;
use Illuminate\Http\Request;

//Real-time facades
use Facades\App\Repositories\Contracts\EventCommentRepoInterface;

class EventscommentController extends Controller
{
    public function store(Request $request)
    {
        //Real-time facades, allows me to access methods in my class as though they are static.
        EventCommentRepoInterface::addCommentForEvent($request);

        return back()->with('success', 'Comment submitted, would be active after being reviewed, thank you.');
    }

}
