<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
  public function run()
  {
    DB::table('book_statuses')->insert([
    'name' => 'Available',
    ]);

    DB::table('book_statuses')->insert([
    'name' => 'Not Available',
    ]);
  }

}
