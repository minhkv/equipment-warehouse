<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Equipment;
use Faker\Generator as Faker;

$factory->define(Equipment::class, function (Faker $faker) {
    return [
        'price' => $faker->numberBetween($min=1, $max=10) * 1000000,
        'supplier_id' => $faker->numberBetween($min=1, $max=5),
        'size' => $faker->randomElement([
            '20', '23', '19.5'
        ]),
        'location' => $faker->numberBetween($min=1, $max=10),
        'condition' => $faker->numberBetween($min=1, $max=5)
    ];
});
