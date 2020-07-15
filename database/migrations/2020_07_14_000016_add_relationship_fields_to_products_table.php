<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToProductsTable extends Migration
{
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->unsignedInteger('region_id');
            $table->foreign('region_id', 'region_fk_1830357')->references('id')->on('regions');
            $table->unsignedInteger('place_id');
            $table->foreign('place_id', 'place_fk_1830358')->references('id')->on('places');
            $table->unsignedInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_1830364')->references('id')->on('users');
            $table->unsignedInteger('category_id');
            $table->foreign('category_id', 'category_fk_1830751')->references('id')->on('categories');
            $table->unsignedInteger('subcategory_id')->nullable();
            $table->foreign('subcategory_id', 'subcategory_fk_1830752')->references('id')->on('subcategories');
        });
    }
}