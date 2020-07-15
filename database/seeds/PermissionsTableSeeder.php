<?php

use App\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => '1',
                'title' => 'user_management_access',
            ],
            [
                'id'    => '2',
                'title' => 'permission_create',
            ],
            [
                'id'    => '3',
                'title' => 'permission_edit',
            ],
            [
                'id'    => '4',
                'title' => 'permission_show',
            ],
            [
                'id'    => '5',
                'title' => 'permission_delete',
            ],
            [
                'id'    => '6',
                'title' => 'permission_access',
            ],
            [
                'id'    => '7',
                'title' => 'role_create',
            ],
            [
                'id'    => '8',
                'title' => 'role_edit',
            ],
            [
                'id'    => '9',
                'title' => 'role_show',
            ],
            [
                'id'    => '10',
                'title' => 'role_delete',
            ],
            [
                'id'    => '11',
                'title' => 'role_access',
            ],
            [
                'id'    => '12',
                'title' => 'user_create',
            ],
            [
                'id'    => '13',
                'title' => 'user_edit',
            ],
            [
                'id'    => '14',
                'title' => 'user_show',
            ],
            [
                'id'    => '15',
                'title' => 'user_delete',
            ],
            [
                'id'    => '16',
                'title' => 'user_access',
            ],
            [
                'id'    => '17',
                'title' => 'atestat_create',
            ],
            [
                'id'    => '18',
                'title' => 'atestat_edit',
            ],
            [
                'id'    => '19',
                'title' => 'atestat_show',
            ],
            [
                'id'    => '20',
                'title' => 'atestat_delete',
            ],
            [
                'id'    => '21',
                'title' => 'atestat_access',
            ],
            [
                'id'    => '22',
                'title' => 'region_create',
            ],
            [
                'id'    => '23',
                'title' => 'region_edit',
            ],
            [
                'id'    => '24',
                'title' => 'region_show',
            ],
            [
                'id'    => '25',
                'title' => 'region_delete',
            ],
            [
                'id'    => '26',
                'title' => 'region_access',
            ],
            [
                'id'    => '27',
                'title' => 'place_create',
            ],
            [
                'id'    => '28',
                'title' => 'place_edit',
            ],
            [
                'id'    => '29',
                'title' => 'place_show',
            ],
            [
                'id'    => '30',
                'title' => 'place_delete',
            ],
            [
                'id'    => '31',
                'title' => 'place_access',
            ],
            [
                'id'    => '32',
                'title' => 'category_create',
            ],
            [
                'id'    => '33',
                'title' => 'category_edit',
            ],
            [
                'id'    => '34',
                'title' => 'category_show',
            ],
            [
                'id'    => '35',
                'title' => 'category_delete',
            ],
            [
                'id'    => '36',
                'title' => 'category_access',
            ],
            [
                'id'    => '37',
                'title' => 'subcategory_create',
            ],
            [
                'id'    => '38',
                'title' => 'subcategory_edit',
            ],
            [
                'id'    => '39',
                'title' => 'subcategory_show',
            ],
            [
                'id'    => '40',
                'title' => 'subcategory_delete',
            ],
            [
                'id'    => '41',
                'title' => 'subcategory_access',
            ],
            [
                'id'    => '42',
                'title' => 'product_create',
            ],
            [
                'id'    => '43',
                'title' => 'product_edit',
            ],
            [
                'id'    => '44',
                'title' => 'product_show',
            ],
            [
                'id'    => '45',
                'title' => 'product_delete',
            ],
            [
                'id'    => '46',
                'title' => 'product_access',
            ],
            [
                'id'    => '47',
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}