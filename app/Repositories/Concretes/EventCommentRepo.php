<?php

namespace App\Repositories\Concretes;

use App\Eventscomment;
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
}