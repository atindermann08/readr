<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
      			$table->string('name');
      			$table->integer('user_id')->unsigned();
      			$table->integer('area_id')->unsigned();
      			$table->string('house_no')->nullable();
      			$table->string('landmark')->nullable();
      			$table->integer('pin_code')->nullable();
            $table->timestamps();
        });

        // Schema::table('addresses', function (Blueprint $table) {
        //     $table->foreign('user_id')
        //           ->references('id')->on('users')
        //           ->onDelete('cascade');
        // });
        //
        // Schema::table('addresses', function (Blueprint $table) {
        //     $table->foreign('area_id')
        //           ->references('id')->on('areas')
        //           ->onDelete('cascade');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('addresses');
    }
}
