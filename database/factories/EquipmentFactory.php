<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Equipment;
use Faker\Generator as Faker;

$factory->define(Equipment::class, function (Faker $faker) {
    return [
        'input_date' => date('Y:m:d H:i:s'),
        'price' => $faker->numberBetween($min=1, $max=10) * 1000000,
        'supplier_id' => $faker->numberBetween($min=1, $max=5),
        'condition' => 2
    ];
});
