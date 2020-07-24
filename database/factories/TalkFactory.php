<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Talk;
use Faker\Generator as Faker;
use Illuminate\Foundation\Inspiring;


$factory->define(Talk::class, function (Faker $faker) {
    return [
        'comment' => Inspiring::quote(),
    ];
});
