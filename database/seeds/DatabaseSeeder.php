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

        Model::reguard();
    }
}
