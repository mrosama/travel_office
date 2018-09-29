<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartnerEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partner_employees', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('partner_id');
            $table->string("name");
            $table->string("nationality");
            $table->enum("gender",['m','f']);
            $table->integer("mobile");
            $table->integer("phone");
            $table->string("email",100);
            $table->string("responsible_for");
            $table->string("skype");
            $table->string("fax");
            $table->text("other");
            $table->text("notes");
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
        Schema::drop('partner_employees');
    }
}
