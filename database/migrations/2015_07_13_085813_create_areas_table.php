<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAreasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('areas', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
      			$table->string('name');
            $table->integer('city_id')->unsigned();
            $table->timestamps();
        });
        // Schema::table('areas', function (Blueprint $table) {
        //     $table->foreign('city_id')
        //           ->references('id')->on('cities')
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
        Schema::drop('areas');
    }
}
