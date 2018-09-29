<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employess', function (Blueprint $table) {
            $table->increments('id');
            $table->string("name");
            $table->integer("mobile");
            $table->integer("office_id");
            $table->integer("country_id");
            $table->enum("gender",array('male','female'));
            $table->string("email",100);
            $table->float("salary");
            $table->integer("civil_registry_number");
            $table->string("work_type",100);
            $table->string("civil_registry_image");
            $table->string("profile_img");
            $table->string("bank_name",100);
            $table->string("iban");
            $table->integer("account_number");
            $table->integer("holidays_number");
            $table->date("hire_date");
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
        Schema::drop('employess');
    }
}
