<?php

use App\Subcategory;
use Illuminate\Database\Seeder;

class SubcategoryTableSeeder extends Seeder
{
    public function run()
    {
        $subcategories = [
            [
                'id'    => 1,
                'category_id' => 1,
                'name' => 'Rosii',
            ],
            [
                'id'    => 2,
                'category_id' => 1,
                'name' => 'Castraveti',
            ],
            [
                'id'    => 3,
                'category_id' => 1,
                'name' => 'Ceapa uscata',
            ],
            [
                'id'    => 4,
                'category_id' => 1,
                'name' => 'Morcovi',
            ],
            [
                'id'    => 5,
                'category_id' => 1,
                'name' => 'Pastarnac',
            ],
            [
                'id'    => 6,
                'category_id' => 1,
                'name' => 'Patrunjel radacina',
            ],
            [
                'id'    => 7,
                'category_id' => 1,
                'name' => 'Telina radacina',
            ],
            [
                'id'    => 8,
                'category_id' => 1,
                'name' => 'Varza',
            ],
            [
                'id'    => 9,
                'category_id' => 1,
                'name' => 'Cartofi albi',
            ],
            [
                'id'    => 10,
                'category_id' => 1,
                'name' => 'Cartofi roz',
            ],
        ];

        Subcategory::insert($subcategories);
    }
}
