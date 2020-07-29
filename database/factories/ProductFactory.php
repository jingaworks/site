<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'category_id' => 1,
        'description' => 'Cras euismod justo vel neque lobortis tristique. Pellentesque vel dui placerat sem ullamcorper ultricies. Mauris eleifend pulvinar urna, eu mollis massa cursus vitae. Nullam eget semper lectus, eu gravida tortor. Ut scelerisque, sem nec tristique viverra, elit nunc cursus massa, ac imperdiet augue sem sagittis nisl. Cras nulla ante, mattis molestie justo ac, rutrum laoreet nunc. Aliquam nec lobortis sem. Etiam nec faucibus massa.',
        'subcategory_id' => 1,
        'price_starts' => $faker->numberBetween(2, 10),
        'price_ends' => $faker->numberBetween(11, 20),
        'region_id' => 13,
        'place_id' => 61265,
        'created_by_id' => 2,
    ];
});
