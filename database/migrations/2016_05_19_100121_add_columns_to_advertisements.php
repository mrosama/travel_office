<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToAdvertisements extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('advertisements', function ($table) {
            $table->string('title')->after('file');
            $table->string('mobile')->after('title');
            $table->string('phone')->after('mobile');
            $table->string('email')->after('phone');
            $table->string('start')->after('email');
            $table->string('end')->after('start');
            $table->string('duration')->after('end');
            $table->string('notes')->after('duration');
            $table->string('designer_name')->after('notes');
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
