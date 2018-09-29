<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyFaxTable extends Migration
{
	public function up()
	{
		Schema::create('company_faxs', function (Blueprint $table) {
			$table->increments('id');
			$table->string('fax');
			$table->integer('company_id');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('company_faxs');
	}
}
