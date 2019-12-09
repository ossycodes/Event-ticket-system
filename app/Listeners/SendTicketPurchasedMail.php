<?php

namespace App\Listeners;

use Ixudra\Curl\Facades\Curl;
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
        Curl::to('https://hooks.slack.com/services/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')
            ->withData([
                'text' => 'Sup Bros,One person just pay for ticket now now, see details below:'.$event->userDetails->name.$event->ticketDetails->data->amount / 100 .$event->ticketDetails->data->metadata->custom_fields[0]->event_name ,
                'fields' => [
                    
                    // [
                        // "username" => $event->userDetails->name,
                        // "amount paid" => $event->ticketDetails->data->amount / 100,
                        // "name" => $event->ticketDetails->data->metadata->custom_fields[0]->event_name,
                    // ]
                        
                    
                ]
            ])
            ->asJson()
            ->post();
        Mail::to($event->userDetails)->send(new TicketPurchasedMail($event->ticketDetails, $event->userDetails->name));
    }
}
