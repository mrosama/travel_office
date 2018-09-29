<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateCompanyOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('company_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('companyId');
            $table->integer('sectionId');  // 0 = All Section Of Company
            $table->string('empId');
            $table->integer('order_type');
            $table->string('date_takeoff');
            $table->string('date_arrival');
            $table->string('dayNumbers');
            $table->string('country_takeoff' , 50);
            $table->integer('city_takeoff');
            $table->string('country_arrival' , 50);
            $table->integer('city_arrival');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::drop('company_orders');
    }
}




