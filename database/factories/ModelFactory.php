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

$factory->define(App\Status::class, function (Faker\Generator $faker) {

    $users = App\User::all();

    return [
        'user_id' => $users->random(1)->first()->id,
        'description' => $faker->sentences( rand(1, 4), true) ,
        'status_id' => null,
        'created_at' => $faker->dateTimeBetween('-7 days'),
    ];
});

$factory->define(App\Comment::class, function (Faker\Generator $faker) {

    $users = App\User::all();
    $statuses = App\Status::all();

    $status = $statuses->random(1)->first();

    return [
        'user_id' => $users->random(1)->first()->id,
        'comment' => $faker->sentences( rand(1, 4), true) ,
        'status_id' => $status->id,
        'created_at' => $faker->dateTimeBetween($status->created_at),
    ];
});

$factory->define(App\Friendship::class, function (Faker\Generator $faker) {

    $users = App\User::all();

    $user = $users->random(1)->first();

    return [
        'user_id' => $user->id,
        'follower_id' => App\User::where('id', '<>', $user->id)->get()->random(1)->first()->id,
    ];
});
