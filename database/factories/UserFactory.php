<?php

use App\User;
use App\Event;
use App\Contact;
use App\Category;
use Carbon\Carbon;
use App\Newsletter;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
 */

$factory->define(User::class, function (Faker $faker) {
    $role = ['user', 'admin'];
    $randomRole = array_rand($role, 1);
    return [
        'name' => $faker->name,
        'role' => $role[$randomRole],
        'email' => $faker->unique()->safeEmail,
        'password' => bcrypt('secret'), // secret
        'remember_token' => str_random(10),
    ];
});

$factory->define(Category::class, function (Faker $faker) {
    return [
        'name' => $faker->word
    ];
});

$factory->define(Newsletter::class, function (Faker $faker) {
    return [
        'email' => $faker->email
    ];
});

$factory->define(Contact::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'email' => $faker->email,
        'phonenumber' => '08027332873',
        'message' => $faker->sentence(), 
    ];
});
