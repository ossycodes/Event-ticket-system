<?php

namespace App\Repositories\Contracts;

interface TicketRepoInterface
{
    public function getTicketsForEvent(int $id); 

    public function totalTicketsForEvent(int $id); 

}