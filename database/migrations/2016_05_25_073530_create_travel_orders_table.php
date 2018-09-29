<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTravelOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('travel_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('travel_officeId');
            $table->integer('sectionId');  // 0 = All Section Of Company
            $table->string('empId');
            $table->integer('order_type');
            $table->string('date_takeoff');
            $table->string('date_arrival');
            $table->string('dayNumbers');
            $table->string('country_takeoff' , 50);
            $table->integer('city_takeoff');
            $table->string('country_arrival' , 50);
            $table->integer('city_arrival');
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
        Schema::drop('travel_orders');
    }
}
