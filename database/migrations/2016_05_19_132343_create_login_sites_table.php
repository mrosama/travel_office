<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoginSitesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('login_sites', function (Blueprint $table) {
				$table->increments('id');
				$table->string('name');
				$table->string('goal');
				$table->string('link');
				$table->string('username');
				$table->string('password');
				$table->string('type');
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
		Schema::drop('login_sites');
	}
}
