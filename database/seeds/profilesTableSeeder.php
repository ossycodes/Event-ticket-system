<?php

use Illuminate\Database\Seeder;
use App\Profile;

class profilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $profiles = [
            [
                'user_id' => '1',
                'gender' => 'male',
                'phonenumber' => '08027332873',
                'education' => 'B.S. in Computer Science from the University of Benin at Edo State',
                'skills' => 'PHP, LARAVEL, JAVASCRIPT, NODE.JS',
                'location' => 'Akesan, Lagos',
            ],

            [
                'user_id' => '2',
                'gender' => 'male',
                'phonenumber' => '080342673873',
                'education' => 'B.S. in Computer Science from the University of Benin at Edo State',
                'skills' => 'PHP, LARAVEL, JAVASCRIPT, NODE.JS, VUE.JS, HTML, CSS,',
                'location' => 'Ikoyi Victoria Island, Lagos',
            ],

        ];

        foreach($profiles as $profile)
            Profile::create($profile);
    }
}
