<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        Schema::create('clients' , function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('username');
            $table->string('username_en');
            $table->string('nationality');
            $table->string('country');
            $table->string('city');
            $table->integer('code');
            $table->integer('mobile');
            $table->string('birth_date');
            $table->string('photo');
            $table->string('mother_name');
            $table->string('email_address');
            $table->integer('phone');
            $table->string('fax');
            $table->string('skype');
            $table->string('twitter');
            $table->string('instgram');
            $table->string('facebook');
            $table->string('passport_number');
            $table->string('family_card');
            $table->string('passport_issue_place');
            $table->string('issue_date');
            $table->string('expire_date');
            $table->string('passpot_copy');
            $table->string('residence_number');
            $table->string('civil_registry_number');
            $table->string('residence_copy');
            $table->string('license_copy');
            $table->string('id_number');
            $table->string('license_issue_date');
            $table->string('license_expire_date');
            $table->string('conservation_number');
            $table->string('issuer');
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
        Schema::drop('clients');
    }
}
