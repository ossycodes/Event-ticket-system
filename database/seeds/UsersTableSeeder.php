<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'admin',
                'role' => 'admin',
                'email' => 'admin@admin.com',
                'password' => bcrypt('xxxxxx'),
            ],

            [
                'name' => 'chris',
                'role' => 'user',
                'email' => 'chris@gmail.com',
                'password' => bcrypt('xxxxxx'),
                'phone' => '2349023802591'
            ],
        ];

        foreach($users as $key => $value)
            User::create($value);
    }
}
