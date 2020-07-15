<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlacesTable extends Migration
{
    public function up()
    {
        Schema::create('places', function (Blueprint $table) {
            $table->increments('id');
            $table->string('denloc');
            $table->string('codp');
            $table->unsignedInteger('jud');
            $table->string('sirsup');
            $table->unsignedInteger('tip');
            $table->unsignedInteger('niv');
            $table->unsignedInteger('med');
            $table->unsignedInteger('regiune');
            $table->unsignedInteger('fsj');
            $table->string('FS2');
            $table->string('FS3');
            $table->unsignedBigInteger('fsl');
            $table->string('rang');
            $table->string('fictiv');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}