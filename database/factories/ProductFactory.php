<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence,
        'merchant_id' => $faker->randomDigitNotNull,
        'price' => $faker->numberBetween($min = 1000, $max = 90000),
        'status' => $faker->boolean,
    ];
});
