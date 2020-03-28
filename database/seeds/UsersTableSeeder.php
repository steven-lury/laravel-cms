<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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
                'name' => 'Reza Asgari',
                'slug' => str_slug('Reza Asgari'),
                'email' => 'reza67asgari@yahoo.com',
                'password' => bcrypt('1234'),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Ali Jafari',
                'slug' => str_slug('Ali Jafari'),
                'email' => 'ali@yahoo.com',
                'password' => bcrypt('1234'),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Hamid Nazari',
                'slug' => str_slug('Hamid Nazari'),
                'email' => 'hamid@yahoo.com',
                'password' => bcrypt('1234'),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]
        ]);
    }
}
