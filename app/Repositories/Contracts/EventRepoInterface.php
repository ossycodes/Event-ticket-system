<?php

namespace App\Repositories\Contracts;

interface EventRepoInterface
{
    public function getAllEvents();

    public function getPaginatedEvents(int $amount);

    public function getPaginatedActiveEvents(int $amount);

    public function getEvent(int $id);

    public function getPaginatedEventsDescendingOrder(int $amount);

    public function getEventWithComments(int $id);

    public function getTotalEvents();
}