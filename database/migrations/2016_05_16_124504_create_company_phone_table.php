<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyPhoneTable extends Migration
{

	public function up()
	{
		Schema::create('company_phones', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('number');
			$table->integer('company_id');
			$table->timestamps();
		});
	}


	public function down()
	{
		Schema::drop('company_phones');
	}
}
