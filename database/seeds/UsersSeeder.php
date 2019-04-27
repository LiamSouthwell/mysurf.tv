<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('users')->insert([
         	'name' => 'Administrator',
            'email' => 'administratormysurf@gmail.com',
            'password' => bcrypt('password'),
            'role' => 2,
         ]);
    }
}
