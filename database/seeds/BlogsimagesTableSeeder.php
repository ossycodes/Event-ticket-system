<?php

use App\Blogsimage;
use Illuminate\Database\Seeder;

class BlogsimagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $blogImages = [
            [
                'blog_id' => 1,
                'imagename' => 'f1.jpg',
                'public_id' => 'djdjdjdjdj',
            ],
            [
                'blog_id' => 2,
                'imagename' => 'f2.jpg',
                'public_id' => 'djdjdjdjdj',
            ],
            [
                'blog_id' => 3,
                'imagename' => 'f3.jpg',
                'public_id' => 'djdjdjdjdj',
            ],
            [  
                'blog_id' => 4,
                'imagename' => 'f4.jpg',
                'public_id' => 'djdjdjdjdj',
            ],
            [
                'blog_id' => 5,
                'imagename' => 'f5.jpg',
                'public_id' => 'djdjdjdjdj'
            ],
        ];

        foreach($blogImages as $image) {
            Blogsimage::create($image);
        }
    }
}
