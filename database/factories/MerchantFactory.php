<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Merchant;
use Faker\Generator as Faker;

$factory->define(Merchant::class, function (Faker $faker) {
    return [
        'country_code' => $faker->countryCode,
        'merchant_name' => $faker->company,
    ];
});
