<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\SystemNotice;
use Faker\Generator as Faker;

$factory->define(SystemNotice::class, function (Faker $faker) {
    return [
        // 返回2条句子，false表示返回一个数组，true表示将三条句子拼成一条返回
        'title' => $faker->sentence(2, true),

        'content' => $faker->text(100),

        'group_name' => '首页',

        'weight' => $faker->numberBetween(0, 100),

        'is_open' => $faker->randomElement([0, 1])
    ];
});
