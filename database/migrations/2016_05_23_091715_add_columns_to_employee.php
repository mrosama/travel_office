<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToEmployee extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employess', function (Blueprint $table) {
            $table->string("nationality")           ->after('office_id');
            $table->string("street")                ->after('nationality');
            $table->string("latitude")              ->after('street');
            $table->string("longitude")             ->after('latitude');
            $table->string("birth_date")            ->after('longitude');
            $table->string("expireResidence")       ->after('birth_date');
            $table->string("sourceResidence")       ->after('expireResidence');
            $table->string("passportNumber")        ->after('sourceResidence');
            $table->string("passport_issue_date")   ->after('passportNumber');
            $table->string("passport_finish_date")  ->after('passport_issue_date');
            $table->string("sourcePassport")        ->after('passport_finish_date');
            $table->string("photoPassport")         ->after('sourcePassport');
            $table->string("days")                  ->after('photoPassport');
            $table->string("hours_from")            ->after('days');
            $table->string("hours_to")              ->after('hours_from');
            $table->string("over_time_price")       ->after('hours_to');
            $table->string("extra_hours_numbers")   ->after('over_time_price');
            $table->string("notes")                 ->after('extra_hours_numbers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
