<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('companies', function (Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->string('work_type');
			$table->string('work_time');
			$table->string('owner_name');
			$table->string('country');
			$table->string('city');
			$table->string('commercial_record');
			$table->string('mailbox');
			$table->string('postal_code');
			$table->string('fax');
			$table->string('logo');
			$table->text('userName');
			$table->text('password');
			$table->string('email');
			$table->integer('mobile');
			$table->integer('phone');
			$table->string('lat');
			$table->string('lang');
			$table->text('address');
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
		Schema::drop('companies');
	}
}
