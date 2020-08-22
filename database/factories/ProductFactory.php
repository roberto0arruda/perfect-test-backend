<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->city,
        'description' => $faker->sentence(),
        'price' => $faker->randomNumber(3),
    ];
});
