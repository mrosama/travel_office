<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('client_orders' , function(Blueprint $table)
       {
        $table->increments('id');
        $table->integer('client_id');
        $table->integer('id_wife');
        $table->string('id_child');
        $table->string('order_type');
        $table->string('country_from');
        $table->string('country_to');
        $table->string('city_from');
        $table->string('city_to');
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
        Schema::drop('client_orders');
    }
}
