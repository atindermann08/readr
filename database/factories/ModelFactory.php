<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function ($faker) {
    return [
        'name' => $faker->firstName,
        'email' => $faker->email,
        'password' => bcrypt('password'),//bcrypt(str_random(10)),
        'remember_token' => str_random(10),
        'active' => 1,
    ];
});
$factory->define(App\Publisher::class, function ($faker) {
    return [
        'name' => $faker->firstName,
    ];
});
$factory->define(App\Category::class, function ($faker) {
    return [
        'name' => $faker->firstName,
    ];
});
$factory->define(App\Language::class, function ($faker) {
    return [
        'name' => $faker->firstName,
    ];
});

$factory->define(App\Book::class, function ($faker) {
    return [
        'title' => $faker->name,
        'description' => $faker->paragraph,
        'publisher_id' => rand(1,4),
        'category_id' => rand(1,4),
        'language_id' => rand(1,4),
        'release_date' => \Carbon\Carbon::now(),
    ];
});

$factory->define(App\BookClub::class, function ($faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->paragraph,
        'rules' => $faker->paragraph,
        'user_id' => rand(1,5),
        'is_closed' => rand(0,1),
    ];
});
