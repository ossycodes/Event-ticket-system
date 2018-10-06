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
                'regular' => 5000,
                'vip' => 10000,
                'tableforten' => 100000,
                'tableforhundred' => 1000000
            ],
                
            [
                'event_id' => 2,
                'regular' => 5000,
                'vip' => 10000,
                'tableforten' => 100000,
                'tableforhundred' => 1000000
            ],

            [
                'event_id' => 3,
                'regular' => 5000,
                'vip' => 10000,
                'tableforten' => 100000,
                'tableforhundred' => 1000000
            ],

            [
                'event_id' => 4,
                'regular' => 5000,
                'vip' => 10000,
                'tableforten' => 100000,
                'tableforhundred' => 1000000
            ],

            [
                'event_id' => 5,
                'regular' => 5000,
                'vip' => 10000,
                'tableforten' => 100000,
                'tableforhundred' => 1000000
            ],

            [
                'event_id' => 6,
                'regular' => 5000,
                'vip' => 10000,
                'tableforten' => 100000,
                'tableforhundred' => 1000000
            ],

        ];

            foreach($tickets as $ticket) {
                Ticket::create($ticket);
            }
    }
}
