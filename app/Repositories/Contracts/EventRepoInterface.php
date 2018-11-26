<?php

namespace App\Repositories\Contracts;

interface EventRepoInterface
{
    public function getPaginatedEvents(int $amount);

    public function getPaginatedActiveEvents(int $amount);
}