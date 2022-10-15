<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\ApiGame;
use Faker\Generator as Faker;

$factory->define(ApiGame::class, function (Faker $faker) {
    return [
        "title" => $faker->sentence(1,true),
        "subtitle" => $faker->sentence(2,true),
        "api_name" => $faker->randomElement(['AG','MG','BBIN','JDB']),
        'game_type' => $faker->randomElement(array_keys(config('platform.game_type'))),
        'weight' => $faker->numberBetween(0, 100),
        'is_open' => $faker->randomElement([0, 1]),
    ];
});
