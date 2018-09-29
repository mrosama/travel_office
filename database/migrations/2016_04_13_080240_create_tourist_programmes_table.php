<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTouristProgrammesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tourist_programmes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('going_date');
            $table->string('flight_days_no');
            $table->string('flight_hours_no');
            $table->string('from_country');
            $table->string('from_city');
            $table->string('from_place');
            $table->string('to_country');
            $table->string('to_city');
            $table->string('to_place');
            $table->string('meals');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tourist_programmes');
    }
}
