<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            //BackgroundsTableSeeder::class,
            BlogsTableSeeder::class,
            CategoriesTableSeeder::class,
            EventsTableSeeder::class,
            EventscommentsTableSeeder::class,
            UsersTableSeeder::class,
            profilesTableSeeder::class,
            ContactsTableSeeder::class,
            PostscommentTableSeeder::class,
            NewsletterTableSeeder::class,

            ]);
    }
}
