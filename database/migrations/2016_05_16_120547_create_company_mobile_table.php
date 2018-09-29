<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyMobileTable extends Migration
{

	public function up()
	{
		Schema::create('company_mobiles', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('number');
			$table->integer('company_id');
			$table->timestamps();
		});
	}


	public function down()
	{
		Schema::drop('company_mobiles');
	}
}
