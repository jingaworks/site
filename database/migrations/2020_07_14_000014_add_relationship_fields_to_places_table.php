<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToPlacesTable extends Migration
{
    public function up()
    {
        Schema::table('places', function (Blueprint $table) {
            $table->unsignedInteger('jud_id')->nullable();
            $table->foreign('jud_id', 'jud_fk_1830321')->references('id')->on('regions');
        });
    }
}