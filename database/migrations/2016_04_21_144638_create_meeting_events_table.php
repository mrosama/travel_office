<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMeetingEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meeting_events', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('meeting_id');
            $table->string('attendants');
            $table->string('file');
            $table->text('positive_remarks');
            $table->text('negative_remarks');
            $table->text('recommendations');
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
        Schema::drop('meeting_events');
    }
}
