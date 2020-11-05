<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    return [
        //Post contents
        'title' => $faker->text(50),
        'body' => $faker->text(200)
    ];
});
