<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id');
            $table->string('receipt');
            $table->string('receipt_photo');
            $table->string('country');
            $table->string('city');
            $table->string('flight_type');
            $table->string('traveles');
            $table->string('date_go');
            $table->string('date_back');
            $table->string('dayNumbers');
            $table->string('dayNights');
            $table->integer('phone');
            $table->integer('mobile');
            $table->string('email');
            $table->string('price_sa');
            $table->string('price_ba');
            $table->string('price_us');
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
        Schema::drop('bills');
    }
}
