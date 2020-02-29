<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        //reset table
        DB::table('users')->truncate();
        //set 3 users
        DB::table('users')->insert([
            [
                'name' => 'Reza',
                'email' => 'reza67asgari@yahoo.com',
                'password' => bcrypt('1234')
            ],
            [
                'name' => 'Ali',
                'email' => 'ali@yahoo.com',
                'password' => bcrypt('1234')
            ],
            [
                'name' => 'Hamid',
                'email' => 'hamid@yahoo.com',
                'password' => bcrypt('1234')
            ]
        ]);
    }
}
