<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookClubsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_clubs', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->string('name');
            $table->text('description',120);
            $table->text('rules', 400)->nullable();
            $table->integer('user_id')->unsigned();
            $table->timestamps();
        });
        // Schema::table('book_clubs', function (Blueprint $table) {
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
        Schema::drop('book_clubs');
    }
}
