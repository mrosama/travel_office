<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartnerPayTransferTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partners_pay_transfer', function(Blueprint $table)
        {
          $table->increments('id');
          $table->integer('partner_id');
          $table->string('required_amount');
          $table->string('paid_amount');
          $table->string('remaining_amount');
          $table->string('pay_from_date');
          $table->string('pay_to_date');
          $table->string('bill_photo');
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
        Schema::drop('partners_pay_transfer');
    }
}
