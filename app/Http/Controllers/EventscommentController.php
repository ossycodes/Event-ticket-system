<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Contracts\EventCommentRepoInterface;

class EventscommentController extends Controller
{
     /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, EventCommentRepoInterface $eventComment)
    {
        // dd('reaching');
        try {
            $eventComment->addCommentForEvent($request);
        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong');
        }

        return back()->with('success', 'Comment submitted, would be active after being reviewed, thank you.');
    }
}
