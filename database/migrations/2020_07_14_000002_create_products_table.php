<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug')->nullable();
            $table->string('name');
            $table->longText('description')->nullable();
            $table->string('price_starts')->nullable();
            $table->string('price_ends')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}