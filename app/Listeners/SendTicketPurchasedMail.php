<?php

namespace App\Listeners;

use App\Events\TicketPurchased;
use App\Mail\TicketPurchasedMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendTicketPurchasedMail implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  TicketPurchased  $event
     * @return void
     */
    public function handle(TicketPurchased $event)
    {
        Mail::to($event->userDetails)->send(new TicketPurchasedMail($event->ticketDetails, $event->userDetails->name));
    }
}
