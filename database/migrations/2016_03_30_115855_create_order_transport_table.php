<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderTransportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_transport' , function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('country_id');
            $table->integer('city_from');
            $table->integer('city_to');
            $table->string('transport_type');
            $table->string('duration');
            $table->integer('order_id');
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
        Schema::drop('order_transport');
    }
}
