<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->truncate();
        DB::table('categories')->insert([
            [
                'title' => 'Web Developing',
                'slug' => 'web-developing'
            ],
            [
                'title' => 'C#',
                'slug' => 'c-sharp'
            ],
            [
                'title' => 'Larvel Framework',
                'slug' => 'laravel-framework'
            ],
            [
                'title' => 'Vue Js',
                'slug' => 'vue-js'
            ]
        ]);
    }
}
