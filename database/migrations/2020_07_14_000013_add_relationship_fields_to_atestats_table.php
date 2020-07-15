<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToAtestatsTable extends Migration
{
    public function up()
    {
        Schema::table('atestats', function (Blueprint $table) {
            $table->unsignedInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_1830310')->references('id')->on('users');
            $table->unsignedInteger('serie_id');
            $table->foreign('serie_id', 'serie_fk_1830318')->references('id')->on('regions');
            $table->unsignedInteger('region_id');
            $table->foreign('region_id', 'region_fk_1830319')->references('id')->on('regions');
            $table->unsignedInteger('place_id');
            $table->foreign('place_id', 'place_fk_1830327')->references('id')->on('places');
        });
    }
}