<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCulomnsToTouristProgram extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tourist_programmes', function(Blueprint $table){
            $table->text('program_notes')->after('supervisors');
            $table->text('launching_notes')->after('program_notes');
            $table->text('arriving_notes')->after('launching_notes');
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
