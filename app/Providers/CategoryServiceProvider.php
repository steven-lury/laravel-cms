<?php

namespace App\Providers;

use App\Category;
use Illuminate\Support\ServiceProvider;

class CategoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('layouts.sidebar', function ($view){
            $categories = Category::has('posts')
                                    ->with(['posts' => function($query){
                                        $query->published();
                                    }])->orderBy('title', 'ASC')->get();
            return $view->with('categories', $categories);
        });
    }
}
