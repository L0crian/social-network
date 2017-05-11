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

    $name = $faker->name;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'slug' => str_slug($name),
        'gender' => 0,
        'avatar' => 'public/defaults/avatars/male.png',
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Post::class, function (Faker\Generator $faker) {

    return [
        'user_id' => 7,
       'content' => $faker->text()
    ];
});

$factory->define(App\Profile::class, function (Faker\Generator $faker) {
    return [
        'location' => $faker->city,
        'about' => $faker->paragraph(4)
    ];
});