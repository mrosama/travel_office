<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmbassiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('embassies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('presence');
            $table->string('country');
            $table->string('city');
            $table->string('street');
            $table->string('site_url');
            $table->string('email');
            $table->string('mobile');
            $table->string('phone');
            $table->string('office');
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
        Schema::drop('embassies');
    }
}
