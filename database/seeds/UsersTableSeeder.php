<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::create(
          [ "email" => "usertest@gmail.com", "name" => "User test", "password" => bcrypt("usertest") ]
        );
    }
}
