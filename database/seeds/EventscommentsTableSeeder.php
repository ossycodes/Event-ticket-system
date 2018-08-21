<?php

use Illuminate\Database\Seeder;
use App\Eventscomment;

class EventscommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $eventscomments = [
            [
                'event_id' => '1',
                'name' => 'yourname',
                'email' => 'youremail@gmail.com',
                'status' => '1',
                'message' => 'But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound but because those who do not know how to pursue pleasure rationally encounter consequences.',
            ],

            [
                'event_id' => '2',
                'name' => 'yourname',
                'email' => 'youremail@gmail.com',
                'status' => '1',
                'message' => 'But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound but because those who do not know how to pursue pleasure rationally encounter consequences.',
            ],

            [
                'event_id' => '3',
                'name' => 'yourname',
                'email' => 'youremail@gmail.com',
                'status' => '1',
                'message' => 'But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound but because those who do not know how to pursue pleasure rationally encounter consequences.',
            ],

            [
                'event_id' => '4',
                'name' => 'yourname',
                'email' => 'youremail@gmail.com',
                'status' => '1',
                'message' => 'But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound but because those who do not know how to pursue pleasure rationally encounter consequences.',
            ],

            [
                'event_id' => '5',
                'name' => 'yourname',
                'email' => 'youremail@gmail.com',
                'status' => '1',
                'message' => 'But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound but because those who do not know how to pursue pleasure rationally encounter consequences.',
            ],

            [
                'event_id' => '6',
                'name' => 'yourname',
                'email' => 'youremail@gmail.com',
                'status' => '1',
                'message' => 'But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound but because those who do not know how to pursue pleasure rationally encounter consequences.',
            ]
        ];

        foreach($eventscomments as $comments)
            Eventscomment::create($comments);
    }
}
