<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNatureWorkTable extends Migration
{
    public function up()
    {
        Schema::create('nature_works', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });
    }   
    public function down()
    {
        Schema::drop('nature_work');
    }
}
