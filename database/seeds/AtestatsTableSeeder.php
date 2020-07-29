<?php

use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class AtestatsTableSeeder extends Seeder
{
    public function run()
    {
        factory(App\Atestat::class)->create();
        // factory(App\Product::class, 50)->create()->each(function ($user) {
        //     // factory(App\Product::class, 100)->make();
        // });
    }
}

