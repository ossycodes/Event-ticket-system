<?php

use Illuminate\Database\Seeder;
use App\Blog;

class BlogsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $blogs = [
            [
                'title' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
                'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
                'body' => 'The Wawomi Franchise is a trademarked events concept owned by Oke fia company. Its debut edition is focused on cross intergrating the visual arts audience and live music audience. A serenading musical offering in an aesthetically perfect space surrounded by art. Music will be played by selected instruments of the band. The audience is a mix of literary and art enthusiast, or simply people who enjoy music with relatable and meaningful content, both young and old. The concept will be aided by costumes, lights, set design, and of course, the already set space of an art gallery. The idea is to bring a performance into a space where music becomes art and the people can visualize the content as an art work. Hence the title, WAWOMI which translates to “come and see me',
            ],

            [
                'title' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
                'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
                'body' => 'The Wawomi Franchise is a trademarked events concept owned by Oke fia company. Its debut edition is focused on cross intergrating the visual arts audience and live music audience. A serenading musical offering in an aesthetically perfect space surrounded by art. Music will be played by selected instruments of the band. The audience is a mix of literary and art enthusiast, or simply people who enjoy music with relatable and meaningful content, both young and old. The concept will be aided by costumes, lights, set design, and of course, the already set space of an art gallery. The idea is to bring a performance into a space where music becomes art and the people can visualize the content as an art work. Hence the title, WAWOMI which translates to “come and see me',
            ],

            [
                'title' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
                'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
                'body' => 'The Wawomi Franchise is a trademarked events concept owned by Oke fia company. Its debut edition is focused on cross intergrating the visual arts audience and live music audience. A serenading musical offering in an aesthetically perfect space surrounded by art. Music will be played by selected instruments of the band. The audience is a mix of literary and art enthusiast, or simply people who enjoy music with relatable and meaningful content, both young and old. The concept will be aided by costumes, lights, set design, and of course, the already set space of an art gallery. The idea is to bring a performance into a space where music becomes art and the people can visualize the content as an art work. Hence the title, WAWOMI which translates to “come and see me',
            ],
            
            [
                'title' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
                'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
                'body' => 'The Wawomi Franchise is a trademarked events concept owned by Oke fia company. Its debut edition is focused on cross intergrating the visual arts audience and live music audience. A serenading musical offering in an aesthetically perfect space surrounded by art. Music will be played by selected instruments of the band. The audience is a mix of literary and art enthusiast, or simply people who enjoy music with relatable and meaningful content, both young and old. The concept will be aided by costumes, lights, set design, and of course, the already set space of an art gallery. The idea is to bring a performance into a space where music becomes art and the people can visualize the content as an art work. Hence the title, WAWOMI which translates to “come and see me',
            ],
            
            [
                'title' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
                'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
                'body' => 'The Wawomi Franchise is a trademarked events concept owned by Oke fia company. Its debut edition is focused on cross intergrating the visual arts audience and live music audience. A serenading musical offering in an aesthetically perfect space surrounded by art. Music will be played by selected instruments of the band. The audience is a mix of literary and art enthusiast, or simply people who enjoy music with relatable and meaningful content, both young and old. The concept will be aided by costumes, lights, set design, and of course, the already set space of an art gallery. The idea is to bring a performance into a space where music becomes art and the people can visualize the content as an art work. Hence the title, WAWOMI which translates to “come and see me',
            ]
        ];
                foreach($blogs as $blog)
                    Blog::create($blog);
    }
}
