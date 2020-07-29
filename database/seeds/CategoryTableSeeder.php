<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    public function run()
    {
        $categories = [
            [
                'id'    => 1,
                'name' => 'Legume',
            ],
            [
                'id'    => 2,
                'name' => 'Fructe',
            ],
            [
                'id'    => 3,
                'name' => 'Lactate',
            ],
        ];

        Category::insert($categories);
    }
}
