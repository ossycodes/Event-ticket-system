<?php

use Illuminate\Database\Seeder;
use App\Event;

class EventsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $events = [
            [
                'category_id' => '1',
                'user_id' => '1',
                'image' => 'https://res.cloudinary.com/cinemaxii/image/upload/v1540855019/cinemaxii/events/event1.jpg',
                'public_id' => 'cinemaxii/events/event1',
                'name' => 'The Basement GIG',
                'venue' => 'The FreeMe Space, Plot, 16A, Block 1394, Nike Art Gallery Road, Ikate Elegushi, Lekki, Lagos.',
                'description' => 'The Basement Gig, a monthly music concert, which showcases the finest emerging music acts, will be holding a special summer edition tagged ‘’TBG SUMMER FEST’’ on August 23rd, 2018 at The FreeMe Space, Ikate Elegushi, Lekki, Lagos. This edition promises to be fun filled with thrilling performances by Zamir, King Perryy, Leriq, Grey C, Blaqbonez, Omagz and Marz & Barzini. The "TBG Summer Fest" is scheduled to kick off at 3pm with an array of games, food, drinks and music from of the best DJs in the land - DJ Jizzi, Dj Crowd Kontroller and the official DJ for The Basement Gig, DJ Six7even. The event will be hosted by the official chaperone of The Basement Gig and media personality, Kemi Smallzz; alongside the super energetic media personality, Sheye Banks',
                'actors' => 'Events actors goes in here 1',
                'time' => '06:00 PM',
                'date' => 'Thursday, Aug 23 ',
                'age' => '18 And Above',
                'dresscode' => 'Freeestyle',
                'status' => '1',
                'quantity' => '5',
            ],

            [   
                'category_id' => '2',
                'user_id' => '1',
                'image' => 'https://res.cloudinary.com/cinemaxii/image/upload/v1540855019/cinemaxii/events/event2.jpg',
                'public_id' => 'cinemaxii/events/event2',
                'name' => 'The BUJ Concert',
                'venue' => 'Chida Event Center, Abuja.',
                'description' => 'The BUJ concert is abuja’s Premier indoor concert to be held at the prestigious Chida Event Center on the 9th of semptember featuring an array of the finest music talents Nigeria has to offer. This is going to be the largest indoor concert ever done in the FCT. Get ready for an experience of a lifetime!',
                'actors' => 'Events actors goes in here 2',
                'time' => '05:00 PM',
                'date' => 'Sunday, Sep 09',
                'age' => '18 And Above',
                'dresscode' => 'Freeestyle',
                'status' => '1',
                'quantity' => '5',
            ],
            
            [
                'category_id' => '2',
                'user_id' => '1',
                'image' => 'https://res.cloudinary.com/cinemaxii/image/upload/v1540855019/cinemaxii/events/event3.jpg',
                'public_id' => 'cinemaxii/events/event3',
                'name' => 'Gala & Award Night',
                'venue' => 'Golden Tulip Hotel, Festac.',
                'description' => 'NAIJA FASHION HOME IS A FASHION PROMOTING PLATFORM THAT USES MODELLING, PHOTOGRAPHY AND EVENTS TO PROMOTE FASHION WITH THE OBJECTIVE OF HELPING FASHION ENTREPRENEURS GROW AND EXPAND THIER BUSINESSES',
                'actors' => 'Events actors goes in here 3',
                'time' => '05:00 PM ',
                'date' => 'Saturday, Aug 18',
                'age' => '18 And Above',
                'dresscode' => 'Freeestyle',
                'status' => '1',
                'quantity' => '5',
            ],

            [
                'category_id' => '1',
                'user_id' => '1',
                'image' => 'https://res.cloudinary.com/cinemaxii/image/upload/v1540855019/cinemaxii/events/event4.jpg',
                'public_id' => 'cinemaxii/events/event4',
                'name' => 'IKD FEST 2018',
                'venue' => 'FunPark, Itamada, Ikorodu, Lagos',
                'description' => 'IKD Fest, Saturday, August 18th, 2018. Time: 11am-9pm Venue: FunPark, Itamada, Ikorodu. Performance: Mayorkun, Idowest, Rayo, Tope Osoba, Darry Jhay',
                'actors' => 'Events actors goes in here 4',
                'time' => '11:00AM',
                'date' => 'Saturday, Aug 18',
                'age' => 'Age goes in here 4',
                'dresscode' => 'Freeestyle',
                'status' => '1',
                'quantity' => '5',
            ],

            [
                'category_id' => '3',
                'user_id' => '2',
                'image' => 'https://res.cloudinary.com/cinemaxii/image/upload/v1540855019/cinemaxii/events/event5.jpg',
                'public_id' => 'cinemaxii/events/event5',
                'name' => 'Pencil Unbroken 3',
                'venue' => 'The Balmoral Hall, Federal Palace Hotel, Victoria Island, Lagos.',
                'description' => 'Pencil Unbroken comedy show tagged Pencil Unbroken The Evolution comes up on Sunday the 26th of August 2018, at The Balmoral Hall . The show promises to be entertaining as Pencil will be performing alongside other comedians and more',
                'actors' => 'Events actors goes in here 5',
                'time' => '06:00 PM',
                'date' => 'Sunday, Aug 26',
                'age' => '18 And Above',
                'dresscode' => 'Casuals',
                'status' => '1',
                'quantity' => '5',
            ],

            [
                'category_id' => '3',
                'user_id' => '2',
                'image' => 'https://res.cloudinary.com/cinemaxii/image/upload/v1540855019/cinemaxii/events/event6.jpg',
                'public_id' => 'cinemaxii/events/event6',
                'name' => 'The Wawomi Tour',
                'venue' => 'Thought Pyramid Gallery, 96, Norman Williams, Ikoyi, Lagos.',
                'description' => 'The Wawomi Franchise is a trademarked events concept owned by Oke fia company. Its debut edition is focused on cross intergrating the visual arts audience and live music audience. A serenading musical offering in an aesthetically perfect space surrounded by art. Music will be played by selected instruments of the band. The audience is a mix of literary and art enthusiast, or simply people who enjoy music with relatable and meaningful content, both young and old. The concept will be aided by costumes, lights, set design, and of course, the already set space of an art gallery. The idea is to bring a performance into a space where music becomes art and the people can visualize the content as an art work. Hence the title, WAWOMI which translates to “come and see me.',
                'actors' => 'Events actors goes in here 6',
                'time' => '06:00 PM',
                'date' => 'Sunday, Aug 26',
                'age' => '18 And Above',
                'dresscode' => 'Casuals',
                'status' => '1',
                'quantity' => '5',
            ]
        ];

        foreach($events as $event)
        Event::create($event);
    }
}
