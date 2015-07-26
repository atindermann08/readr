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
        'name' => 'Atinder',//$faker->name,
        'email' => 'atindermann08@gmail.com',//$faker->email,
        'password' => bcrypt('password'),//bcrypt(str_random(10)),
        'remember_token' => str_random(10),
        'active' => 1,
    ];
});
