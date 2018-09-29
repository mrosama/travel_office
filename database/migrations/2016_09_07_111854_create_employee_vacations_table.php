<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeVacationsTable extends Migration {

    public function up() {
        Schema::create('employee_vacations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('emp_id');
            $table->integer('vacation_type_id');
            $table->string('day_number', 30);
            $table->string('vacation_start', 30);
            $table->string('vacation_end', 30);
            $table->string('reason');
            $table->string('nature');
            $table->string('remaining', 30);
            $table->string('previous', 30);
            $table->text('notes');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::drop('employee_vacations');
    }

}
