<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\User;

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
        // $this->call(UserTableSeeder::class);

        factory(User::class)->create();
        Model::reguard();
    }
}
