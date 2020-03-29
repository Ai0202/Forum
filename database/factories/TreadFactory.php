<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Thread;
use App\User;
use Faker\Generator as Faker;

$factory->define(Thread::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(),
        'body' => $faker->paragraph(),
        'user_id' => factory(User::class)->create()->id,
    ];
});
