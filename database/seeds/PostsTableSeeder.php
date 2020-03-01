<?php

use Faker\Factory;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('posts')->truncate();
        //generate 10 new posts
        $posts = [];
        $now = Carbon::now();
        $facker = Factory::create();
        for($i=1; $i<=10; $i++){
            $image = 'Post_image_'.rand(1, 5).'.jpg';
            $posts[] = [
                'user_id' => rand(1, 3),
                'title' => $facker->sentence(rand(3, 6)),
                'slug' => $facker->slug(),
                'body' => $facker->paragraphs(rand(250, 300), true),
                'excerpt' => $facker->text(rand(230, 236)),
                'image' => rand(0, 1) == 1 ? $image : NULL,
                'created_at' => $now->copy()->subDays($i),
                'updated_at' => $now->copy()->subDays($i),
                'published_at' => rand(0, 1) == 1 ? NULL : $now->copy()->subDays(rand(3, 6))
            ];
        }
        DB::table('posts')->insert($posts);
    }
}
