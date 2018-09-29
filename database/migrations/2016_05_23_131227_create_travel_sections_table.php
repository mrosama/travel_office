<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTravelSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('travel_sections', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sectionName');
            $table->integer('travel_officeId');
            $table->integer('phone');
            $table->integer('mobile');
            $table->string('email');
            $table->string('fax');
            $table->string('ext');
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
        Schema::drop('travel_sections');
    }
}
