<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\User;
use Carbon\Carbon;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

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
    
    //$now = Carbon::now()->toDateTimeString();
    
    return [
        'name' => $faker->username,
        // 'email' => $faker->unique()->safeEmail,
        'password' => bcrypt("123456"),
        'create_ip' => $faker->ipv4,
        'remember_token' => Str::random(10),
        'status' => $faker->randomElement([-1,1]),
        //'created_at' => $now,
        //'updated_at' => $now
    ];
});
