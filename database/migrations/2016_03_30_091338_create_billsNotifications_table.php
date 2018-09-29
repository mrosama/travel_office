<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillsNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("bills_notifications", function(Blueprint $table){
           $table->increments('id');
           $table->integer('bill_id');
           $table->text('message');
           $table->enum('seen' , ['0','1']); //0->notificaition not seen yet , 1->seen
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
        Schema::drop('bills_notifications');
    }
}
