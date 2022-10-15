<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\About;
use Faker\Generator as Faker;

$factory->define(About::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(2, true),
        'content' => $faker->randomHtml(2, 9),
        'type' => $faker->randomElement(array_keys(config('platform.about_type'))),
        'weight' => $faker->numberBetween(0, 100),
        'is_open' => $faker->randomElement([0, 1]),
        'is_hot' => $faker->randomElement([0, 1])
    ];
});
