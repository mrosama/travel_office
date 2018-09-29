<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToVisas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('visas', function(Blueprint $table){
            $table->integer('embassy_id')->after('visa_duration');
            $table->string('fill_form_online')->after('embassy_id');
            $table->string('fill_form_external')->after('fill_form_online');
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
