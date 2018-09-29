<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('from_country');
            $table->string('to_country');
            $table->integer('booking_flight')->default(0);
            $table->integer('hotel_booking')->default(0);
            $table->integer('action_definition')->default(0);
            $table->integer('health_insurance')->default(0);
            $table->integer('passport_photocopy')->default(0);
            $table->integer('account_statement')->default(0);
            $table->integer('visa_in_airport')->default(0);
            $table->string('total_photos');
            $table->string('fill_out_form');
            $table->string('payment_of_fees');
            $table->string('visa_duration');
            $table->text('notes')->nullable();
            $table->string('file')->nullable();
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
        Schema::drop('visas');
    }
}
