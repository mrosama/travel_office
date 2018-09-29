<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransportTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transport_types' , function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('country_id');
            $table->integer('city_from');
            $table->integer('city_to');
            $table->string('transport_type');
            $table->string('duration');
            $table->string('space');
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
        Schema::drop('transport_types');
    }
}
