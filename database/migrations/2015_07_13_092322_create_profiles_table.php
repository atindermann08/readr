<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->string('image')->nullable();
            $table->string('about')->nullable();
            $table->integer('user_id')->unsigned();
            $table->timestamps();
        });

        // Schema::table('profiles', function (Blueprint $table) {
        //     $table->foreign('user_id')
        //           ->references('id')->on('users')
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
        Schema::drop('profiles');
    }
}
