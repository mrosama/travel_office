<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToBusess extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table("buses", function(Blueprint $table){
           $table->string('latitude')->after('supplier_id');
           $table->string('longitude')->after('latitude');
           $table->string('run_card_number')->after('longitude');
           $table->string('hajj_permit')->after('run_card_number');
           $table->string('permit_number')->after('hajj_permit');
           $table->string('permit_duration')->after('permit_number');
           $table->string('permit_date')->after('permit_duration');
           $table->string('permit_end_date')->after('permit_date');
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
