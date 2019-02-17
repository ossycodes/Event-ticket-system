<?php

namespace App\Http\Controllers\Admin;

use App\Event;
use validator;
use Illuminate\Http\Request;

use App\Repositories\Contracts\EventCommentRepoInterface;

class EventscommentController extends \App\Http\Controllers\Controller
{
    protected $eventComment;

    /**
     * EventscommentController constructor.
     * @param EventCommentRepoInterface $eventComment
     */
    public function __construct(EventCommentRepoInterface $eventComment)
    {
        $this->eventComment = $eventComment;
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function activateComment($id)
    {
        try {
            $this->eventComment->activateComment($id);
        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong');
        }
        return back()->with('success', 'Comment successfully activated');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deactivateComment($id)
    {
        try {
            $this->eventComment->deActivateComment($id);
        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong');
        }

        return back()->with('success', 'Comment successfully de-activated');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteComment($id)
    {
        try {
            $this->eventComment->deleteComment($id);
        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong');
        }

        return back()->with('success', 'Comment deleted successfully');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showComments($id)
    {
        $eventComments = $this->eventComment->getCommentsForEvent($id);
        $noOfComments = $this->eventComment->getTotalComments();
        return view('admin.events.comments', compact('eventComments', 'noOfComments'));
    }

}
