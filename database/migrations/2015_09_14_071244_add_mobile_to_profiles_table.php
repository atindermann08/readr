<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMobileToProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('profiles', function(Blueprint $table) {
            $table->string('mobile')->after('image')->nullable();
            $table->dropColumn('about');
        });

        Schema::table('profiles', function(Blueprint $table) {
            $table->string('about')->after('mobile')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('profiles', function(Blueprint $table) {
            $table->dropColumn('mobile');
        });
    }
}
