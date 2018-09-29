<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTravelOfficeFaxsTable extends Migration
{
    public function up()
    {
        Schema::create('travel_officeFaxs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fax');
            $table->integer('travel_officeId');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('travel_officeFaxs');
    }
}

