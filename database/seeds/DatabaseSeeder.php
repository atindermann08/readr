<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Book;
use App\BookClub;
use App\Publisher;
use App\Category;
use App\Language;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        User::truncate();
        Book::truncate();
        BookClub::truncate();
        Publisher::truncate();
        Category::truncate();
        Language::truncate();
        // $this->call(UserTableSeeder::class);

        // factory(User::class, 5)->create();
        $this->call(UserTableSeeder::class);
        factory(Book::class, 14)->create();
        factory(BookClub::class, 6)->create();
        factory(Category::class, 3)->create();
        factory(Publisher::class, 3)->create();
        factory(Language::class, 3)->create();

        DB::table('book_statuses')->insert([
          'name' => 'Available',
          ]);

        DB::table('book_statuses')->insert([
          'name' => 'Not Available',
          ]);

        Model::reguard();
    }
}


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
