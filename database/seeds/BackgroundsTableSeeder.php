<?php

use Illuminate\Database\Seeder;
use App\Background;

class BackgroundsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $backgrounds = [    
            [
                'image' => 'header-bg.jpg',
                'name' => 'Big 20',
                'age' => '18',
                'genre' => 'Animation, Action, Comedy',
                'location' => 'Don Hall, Chris Williams',
                'release' => '27 November 2014',
                'description' => 'The special bond that develops between plus-sized inflatable robot Baymax, and prodigy Hiro Hamada, who team up with a group of friends to form a band of high-tech heroes.',
                'linktoticket' => '/movies/1',
                'linttotrailer' => 'url goes here',
            ]
        ];  

        foreach($backgrounds as $background)
            Background::create($background);
    }
}
