<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTravelOfficeEmailsTable extends Migration
{

    public function up()
    {
        Schema::create('travel_officeEmails', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email');
            $table->integer('travel_officeId');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::drop('travel_officeEmails');
    }
}

