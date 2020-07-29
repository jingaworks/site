<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Atestat;
use Faker\Generator as Faker;

$factory->define(Atestat::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'address' => $faker->address,
        'number'=> $faker->unique()->numberBetween(1000000, 9999999),
        'serie_id' => 13,
        'region_id' => 13,
        'place_id' => 61265,
        'created_by_id' => 2,
        ];    
});