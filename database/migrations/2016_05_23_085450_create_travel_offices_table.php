<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTravelOfficesTable extends Migration
{

    public function up()
    {
        Schema::create('travel_offices', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('work_time');
            $table->string('owner_name');
            $table->string('country');
            $table->string('city');
            $table->string('commercial_record');
            $table->string('mailbox');
            $table->string('postal_code');
            $table->string('fax');
            $table->string('logo');
            $table->string('email');
            $table->integer('mobile');
            $table->integer('phone');
            $table->string('address');
            $table->string('lat');
            $table->string('lang');
            $table->string('userName');
            $table->string('password');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('travel_offices');
    }
}
