<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salaries', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('employee_id');
            $table->string('basic_salary');
            $table->string('transportation_allowance');
            $table->string('house_allowance');
            $table->string('number_extra_hours');
            $table->string('number_extra_days');
            $table->string('holiday_allowance');
            $table->string('other_allowances');
            $table->string('amount_deducted');
            $table->string('discount_reason');
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
        Schema::drop('salaries');
    }
}
