<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            // $table->engine = "InnoDB";
            $table->increments('id');
            $table->string('title');
            $table->text('description',120)->nullable();
            $table->string('image')->nullable();
            $table->integer('author_id')->unsigned();
            $table->integer('publisher_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->integer('language_id')->unsigned();
            $table->date('release_date')->nullable();
            $table->timestamps();
        });
        // Schema::table('books', function (Blueprint $table) {
        //   $table->foreign('author_id')
        //         ->references('id')->on('authors')
        //         ->onDelete('cascade');
        //   $table->foreign('publisher_id')
        //         ->references('id')->on('publishers')
        //         ->onDelete('cascade');
        //   $table->foreign('category_id')
        //         ->references('id')->on('categories')
        //         ->onDelete('cascade');
        //   $table->foreign('language_id')
        //         ->references('id')->on('languages')
        //         ->onDelete('cascade');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('books');
    }
}
