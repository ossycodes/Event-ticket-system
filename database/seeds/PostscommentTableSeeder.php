<?php

use Illuminate\Database\Seeder;
use App\Postscomment;

class PostscommentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $postComments = [
            [
                'blog_id' => '1',
                'name' => 'default@gmiail.com',
                'message' => 'This is just a default comment from lorem ispium blah blah',
            ],

            [
                'blog_id' => '2',
                'name' => 'default@gmiail.com',
                'message' => 'This is just a default comment from lorem ispium blah blah',
            ],

            [
                'blog_id' => '3',
                'name' => 'default@gmiail.com',
                'message' => 'This is just a default comment from lorem ispium blah blah',
            ],

            [
                'blog_id' => '4',
                'name' => 'default@gmiail.com',
                'message' => 'This is just a default comment from lorem ispium blah blah',
            ],

            [
                'blog_id' => '5',
                'name' => 'default@gmiail.com',
                'message' => 'This is just a default comment from lorem ispium blah blah',
            ],

        ];

            foreach($postComments as $comment)
              Postscomment::create($comment);
    }
}
