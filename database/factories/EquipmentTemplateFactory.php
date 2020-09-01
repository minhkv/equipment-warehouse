<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\EquipmentTemplate;
use Faker\Generator as Faker;

$factory->define(EquipmentTemplate::class, function (Faker $faker) {
    return [
        'name' => $faker->randomElement([
            'Máy ảnh Canon Ixus 185',
            'Canon EOS M50',
            'Canon EOS 3000D',
            'Canon PowerShot G7X Mark II',
            'Sony Gopro',
            'Sony Handy Cam',
            'Sony Action Cam',
            'DJI Osmo Pocket',
            'Xiaomi action 4K'
        ]),
        'category_id' => $faker->numberBetween($min=1, $max=5),
        'image' => $faker->randomElement([
            join(DIRECTORY_SEPARATOR, ['/storage', 'img', 'icons8-angularjs-144.png']),
            join(DIRECTORY_SEPARATOR, ['/storage', 'img', 'icons8-c-programming-96.png']),
            join(DIRECTORY_SEPARATOR, ['/storage', 'img', 'icons8-nodejs-144.png']),
            join(DIRECTORY_SEPARATOR, ['/storage', 'img', 'sony-handycam.webp']),
            join(DIRECTORY_SEPARATOR, ['/storage', 'img', 'camera-hanh-dong-xiaomi-action-4k(2).jpg']),
            join(DIRECTORY_SEPARATOR, ['/storage', 'img', 'sony-hxrnx100-he-ntsc.jpg']),
            join(DIRECTORY_SEPARATOR, ['/storage', 'img', 'sony-hdrcx405e-mau-den(2).jpg'])
        ]),
    ];
});