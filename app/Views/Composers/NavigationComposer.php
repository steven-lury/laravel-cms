<?php

namespace App\Views\Composers;

use Illuminate\View\View;
use App\Post;
use App\Category;

class NavigationComposer {

    public function compose(View $view){

        $this->composeCategory($view);
        $this->composePopular($view);

    }

    private function composeCategory(View $view){

        $categories = Category::has('posts')
                                    ->with(['posts' => function($query){
                                        $query->published();
                                    }])->orderBy('title', 'ASC')->get();
        $view->with('categories', $categories);

    }

    private function composePopular(View $view){

        $popularPosts = Post::published()->popular()->inRandomOrder()->take(3)->get();
        $view->with('populars', $popularPosts);

    }
}
