<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBussesSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('busses_suppliers' , function(Blueprint $table){
             $table->increments('id');
             $table->string('name');
             $table->string('tel');
             $table->string('mobile');
             $table->string('email');
             $table->string('twitter');
             $table->string('face');
             $table->string('skype');
             $table->string('Commercial_record_no');
             $table->string('country');
             $table->string('city');
             $table->string('street');
             $table->string('logo');
             $table->string('notes');
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
        Schema::drop("busses_suppliers");
    }
}
