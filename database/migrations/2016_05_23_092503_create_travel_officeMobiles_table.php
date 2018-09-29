<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTravelOfficeMobilesTable extends Migration
{
    public function up()
    {
        Schema::create('travel_officeMobiles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('number');
            $table->integer('travel_officeId');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('travel_officeMobiles');
    }
}

