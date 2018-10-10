<?php

use App\Eventsliderimages;
use Illuminate\Database\Seeder;

class EventsliderimagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sliderImages = [
            [
                'slider_imagename' => 'event1.jpg'
            ],
            [
                'slider_imagename' => 'event2.jpg'
            ],
            [
                'slider_imagename' => 'event3.jpg'
            ],
            [
                'slider_imagename' => 'event4.jpg'
            ],
            [
                'slider_imagename' => 'event5.jpg'
            ],
            [
                'slider_imagename' => 'event6.jpg'
            ],
        ];

        foreach($sliderImages as $image) {
            Eventsliderimages::create($image);
        }
    }
}
