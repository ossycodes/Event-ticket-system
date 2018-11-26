<?php

namespace App\Repositories\Contracts;

interface EventCommentRepoInterface
{
    public function totalNumberOfComments(int $id, int $status);
}