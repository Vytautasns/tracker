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

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});


$factory->define(App\Program::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->text,
        'image_url' => 'some https',
        'default' => 1,
    ];
});

$factory->define(App\Exercise::class, function (Faker\Generator $faker) {
    return [
        'name' => 'Exercise ' . $faker->name,
        'category_id' => 0,
        'description' => $faker->text,
        'image_url' => 'some https',
        'default' => 1,
    ];
});

$factory->define(App\Day::class, function (Faker\Generator $faker) {
    return [
        'name' => 'Day ' . $faker->name,
        'program_id' => 1,
    ];
});
