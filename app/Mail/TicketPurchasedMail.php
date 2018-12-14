<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TicketPurchasedMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    CONST KOBO = 100;
    protected $data;
    protected $userName;

    public function __construct($data, $userName)
    {
        $this->ticketInfo = $data;
        $this->userName = $userName;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $transactionDashboardUrl = 'http://localhost:8000/user/transactions';
        return $this->from('hello@cinemaxii.com')
                ->markdown('emails.ticketPurchased')
                ->with([
                    'ticketAmount' => $this->ticketInfo->data->amount/SELF::KOBO,
                    'ticketReference' => $this->ticketInfo->data->reference,
                    'ticketName' => $this->ticketInfo->data->metadata->custom_fields[0]->event_name,
                    'ticketId' => $this->ticketInfo->data->id,
                    'userName' => $this->userName,
                    'url' => $transactionDashboardUrl
                ]);
    }
}
