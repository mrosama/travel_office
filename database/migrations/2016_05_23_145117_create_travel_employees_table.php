<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTravelEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('travel_employees', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('travel_officeId');
            $table->integer('sectionId');
            $table->string('empName');
            $table->string('nationality');
            $table->integer('mobile');
            $table->integer('phone');
            $table->string('email');
            $table->string('ext');
            $table->string('emp_photo');
            $table->string('sex');
            $table->string('birthDate');
            $table->string('No_civilRegistry');
            $table->string('expireResidence');
            $table->string('sourceResidence');
            $table->string('photoResidence');
            $table->string('passportNumber');
            $table->string('passport_issue_date');
            $table->string('passport_finish_date');
            $table->string('sourcePassport');
            $table->string('photoPassport');
            $table->text('notes');
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
        Schema::drop('travel_employees');
    }
}
