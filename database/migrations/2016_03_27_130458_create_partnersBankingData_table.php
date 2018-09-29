<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartnersBankingDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partners_banking_data' , function(Blueprint $table){
              $table->increments('id');
              $table->integer('partner_id');
              $table->string('country');
              $table->string('city');
              $table->string('bank_name');
              $table->string('bank_number');
              $table->string('bank_account_owner');
              $table->string('iban');
              $table->string('other');
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
        Schema::drop('partners_banking_data');
    }
}
