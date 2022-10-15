<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Activity;
use Faker\Generator as Faker;

$factory->define(Activity::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(2, true),
        'subtitle' => $faker->sentence(1, true),
        'content' => $faker->randomHtml(2, 9),
        // 'web_pic' => 'https://dummyimage.com/600x400/000/fff',
        'is_apply' => $faker->randomElement([0, 1]),
        'type' => $faker->randomElement(array_keys(config('platform.activity_type'))),
        'weight' => $faker->numberBetween(0, 100),
        'is_open' => $faker->randomElement([0, 1]),
    ];
});
