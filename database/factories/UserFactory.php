<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use Illuminate\Support\Str;
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
    $twitter_users = [
        'JoyasGames', 'LNTecnologia', 'marcos_galperin', 'pibesdesistemas', 'woloski', 'SomosCodear', 'SpaceX', 'RiverPlate', 'elonmusk', 'ginotubaro', 'JeffBezos', 'ViajarOmorir', 'BsAs_recuerdo', 'UnrealEngine', 'brave'
    ];
    return [
        'name' => $faker->name,
        'username' => $faker->userName,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'api_token' => Str::random(60),
        'remember_token' => Str::random(10),
        'twitter_username' => $faker->randomElement($twitter_users)
    ];
});
