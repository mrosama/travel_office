<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIncomesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incomes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('employee_id');
            $table->string('receipt');
            $table->string('receipt_type');
            $table->string('receipt_photo');
            $table->string('receipt_date');
            $table->string('receipt_daily_total');
            $table->string('receipt_daily_number');
            $table->string('money_source');
            $table->string('notes');
            $table->string('total');
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
        Schema::drop('incomes');
    }
}
