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

    public function createEventWithOneTicket($ticketType, $ticketPrice)
    {
        return
            $ticket = new Ticket;
            $ticket->event_id = $createdEvent->id;
            $ticket->tickettype = $ticketType;
            $ticket->price = $ticketPrice;
            $ticket->save();
    }

    public function createEventWithMultipleTicket($data)
    {
        // dd($data);
        foreach ($data['key'] as $key => $val) {
         
        return 
            $ticket = new Ticket;
            $ticket->event_id = $createdEvent->id;
            $ticket->tickettype = $val;
            $ticket->price = $data['value'][$key];
            $ticket->save();
        }
    }

    public function createEventWithNoTicket()
    {
        return 
            $ticket = new Ticket;
            $ticket->event_id = $createdEvent->id;
            $ticket->tickettype = null;
            $ticket->price = null;
            $ticket->save();
    }
}