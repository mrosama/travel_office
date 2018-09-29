<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservedBusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reserved_buses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('supplier_id');
            $table->integer('driver_id');
            $table->integer('bus_id');
            $table->integer('tourist_program_id');
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
        Schema::drop('reserved_buses');
    }
}
