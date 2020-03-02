<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Post;

class PostsController extends Controller
{
    private $limit = 4;

    public function index()
    {
       // \DB::enableQueryLog();
        $posts = Post::with('user', 'comments')->firstLatest()->published()->simplePaginate($this->limit);
        return view('index', compact('posts'));//->render();
        //  dd(\DB::getQueryLog());
    }

    public function show(Post $post){

        return view('show', compact('post'));

    }

    public function category(Category $category)
    {
        $posts = $category->posts()->with('user')
                    ->firstLatest()
                    ->published()
                    ->simplePaginate($this->limit);
        return view('index', compact('posts'));
    }

}
