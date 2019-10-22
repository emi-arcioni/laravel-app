<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Entry;
use Faker\Generator as Faker;

$factory->define(Entry::class, function (Faker $faker) {
    $date = $faker->dateTimeThisYear()->format("Y-m-d H:i:s");

    return [
        'title' => $faker->text(100),
        'content' => $faker->realText(2000),
        'created_at' => $date,
        'updated_at' => $date
    ];
});
