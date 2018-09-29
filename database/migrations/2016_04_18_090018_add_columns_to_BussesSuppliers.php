<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToBussesSuppliers extends Migration
{
    /** 
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table("busses_suppliers", function(Blueprint $table){
           $table->string('mailbox')->after('logo');
           $table->string('postal_code')->after('mailbox');
           $table->string('fax')->after('postal_code');
           $table->string('website')->after('fax');
           $table->string('commercial_reg_img')->after('website');
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
