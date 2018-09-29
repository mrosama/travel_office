<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('country');
            $table->string('city');
            $table->string('type');
            $table->string('duration_in_days');
            $table->string('duration_in_weeks');
            $table->string('duration_in_month');
            $table->string('start_date');
            $table->string('end_date');
            $table->string('level');
            $table->string('language');
            $table->string('dayly_hours');
            $table->string('total_hours');
            $table->string('price');
            $table->text('conditions');
            $table->string('advertisment_date');
            $table->string('advertisment_duration');
            $table->string('advertisment_photo')->nullable();
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
        Schema::drop('courses');
    }
}
