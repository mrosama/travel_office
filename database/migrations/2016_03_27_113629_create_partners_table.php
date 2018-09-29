<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partners' , function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('name');
            $table->string('mobile');
            $table->string('phone');
            $table->text('email');
            $table->string('site_url');
            $table->string('logo');
            $table->string('country');
            $table->string('city');
            $table->string('street');
            $table->string('latitude');
            $table->string('longitude');
            $table->string('mail_box');
            $table->string('fax');
            $table->string('skype');
            $table->string('twitter');
            $table->string('facebook');
            $table->string('other');
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
        Schema::drop('partners');
    }
}
