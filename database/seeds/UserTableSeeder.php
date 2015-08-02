<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
          'name' => 'atinder',
          'email' => 'atinder@gmail.com',
          'password' => bcrypt('password'),//bcrypt(str_random(10)),
          'remember_token' => str_random(10),
          'active' => 1,
          ]);

        DB::table('users')->insert([
          'name' => 'jaspreet',
          'email' => 'jaspreet@gmail.com',
          'password' => bcrypt('password'),//bcrypt(str_random(10)),
          'remember_token' => str_random(10),
          'active' => 1,
          ]);

        DB::table('users')->insert([
          'name' => 'vinay',
          'email' => 'vinay@gmail.com',
          'password' => bcrypt('password'),//bcrypt(str_random(10)),
          'remember_token' => str_random(10),
          'active' => 1,
          ]);

        DB::table('users')->insert([
          'name' => 'amit',
          'email' => 'amit@gmail.com',
          'password' => bcrypt('password'),//bcrypt(str_random(10)),
          'remember_token' => str_random(10),
          'active' => 1,
          ]);

        DB::table('users')->insert([
          'name' => 'maninder',
          'email' => 'maninder@gmail.com',
          'password' => bcrypt('password'),//bcrypt(str_random(10)),
          'remember_token' => str_random(10),
          'active' => 1,
          ]);

    }
}
