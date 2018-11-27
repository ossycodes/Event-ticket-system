<?php

namespace App\Repositories\Concretes;

use App\Repositories\Contracts\TicketRepoInterface;
use App\Ticket;

class TicketRepo implements TicketRepoInterface
{
    public function getTicketsForEvent(int $id)
    {
        return Ticket::where('event_id', '=', $id)->get();
    }

    public function totalTicketsForEvent(int $id)
    {
        return Ticket::where('event_id', '=', $id)->where('price', '!=', ' ')->count();
    }

    public function getTicket(int $id)
    {
        return Ticket::findOrFail($id);
    }

    public function getTotalTickets()
    {
        return Ticket::count();
    }

    public function getTotalTicketsForEvent(int $id)
    {
        return Ticket::where('event_id', '=', $id)->count();
    }
}