<?php

use App\Ticket;
use Illuminate\Database\Seeder;

class TicketsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tickets = [
            [
                'event_id' => 1,
                'tickettype' => 'Regular',
                'price' => 10000,
            ],
                
            [
                'event_id' => 2,
                'tickettype' => 'Regular',
                'price' => 10000,
            ],

            [
                'event_id' => 3,
                'tickettype' => 'Regular',
                'price' => 10000,
            ],

            [
                'event_id' => 4,
                'tickettype' => 'Regular',
                'price' => 10000,
            ],

            [
                'event_id' => 5,
                'tickettype' => 'Regular',
                'price' => 10000,
            ],

            [
                'event_id' => 6,
                'tickettype' => 'Regular',
                'price' => 10000,
            ],

        ];

            foreach($tickets as $ticket) {
                Ticket::create($ticket);
            }
    }
}
