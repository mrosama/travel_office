<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('expenses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('exchangeType_id');
            $table->string('income_date');
            $table->string('income_period');
            $table->string('amount_paid');
            $table->string('remaning_amount');
            $table->string('total_amount');
            $table->text('notes');
            $table->string('attachment');
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
        Schema::drop('expenses');
    }
}
