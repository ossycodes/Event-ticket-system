<?php

use Illuminate\Database\Seeder;
use App\Newsletter;

class NewsletterTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subscribers =  [
            ['email' => 'loremispuim@gmail.com'],
            ['email' => 'loremlablahblah@gmail.com'],
        ];

        foreach($subscribers as $subscriber)
            Newsletter::create($subscriber);
    }
}
