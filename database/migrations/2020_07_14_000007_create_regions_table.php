<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegionsTable extends Migration
{
    public function up()
    {
        Schema::create('regions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('denj', 40);
            $table->tinyInteger('fsj');
            $table->string('mnemonic', 4);
            $table->tinyInteger('zona');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}