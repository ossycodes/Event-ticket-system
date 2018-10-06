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
            UsersTableSeeder::class,
            profilesTableSeeder::class,
            BlogsTableSeeder::class,
            CategoriesTableSeeder::class,
            EventsTableSeeder::class,
            TicketsTableSeeder::class,
            EventscommentsTableSeeder::class,
            ContactsTableSeeder::class,
            NewsletterTableSeeder::class,
            PostscommentTableSeeder::class,
            

            ]);
    }
}
