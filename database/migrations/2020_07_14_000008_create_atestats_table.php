<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAtestatsTable extends Migration
{
    public function up()
    {
        Schema::create('atestats', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->longText('address');
            $table->string('number');
            $table->date('valid_year')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}