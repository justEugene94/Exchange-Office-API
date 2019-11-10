<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\Coefficient;
use Faker\Generator as Faker;

$factory->define(Coefficient::class, function (Faker $faker) {
    return [
        'amount'  => $faker->numberBetween(5, 45),
        'percent' => $faker->randomFloat(2, 0, 1),
    ];
});
