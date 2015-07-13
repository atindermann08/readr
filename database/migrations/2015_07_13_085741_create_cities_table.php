<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
      			$table->string('name');
            $table->integer('state_id')->unsigned();
            $table->timestamps();
        });
        // Schema::table('cities', function (Blueprint $table) {
        //     $table->foreign('state_id')
        //           ->references('id')->on('states')
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
        Schema::drop('cities');
    }
}
