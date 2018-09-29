<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTravelOfficePhonesTable extends Migration
{

    public function up()
    {
        Schema::create('travel_officePhones', function (Blueprint $table) {
            $table->increments('id');
            $table->string('number');
            $table->integer('travel_officeId');
            $table->timestamps();
        });    
    }

    public function down()
    {
        Schema::drop('travel_officePhones');
    }
}




