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
       $categories = Category::has('posts')->orderBy('title', 'ASC')->get();
        $posts = Post::with('user', 'comments')->firstLatest()->published()->simplePaginate($this->limit);
        return view('index', compact('posts', 'categories'));//->render();
        //  dd(\DB::getQueryLog());
    }

    public function show(Post $post){

        $categories = Category::with('posts')->orderBy('title', 'ASC')->get();
        return view('show', compact('post', 'categories'));

    }

    public function category($id)
    {
        $categories = Category::with('posts')->has('posts')->orderBy('title', 'ASC')->get();
        $posts = Post::with('user')
                    ->firstLatest()
                    ->published()
                    ->where('category_id', $id)
                    ->simplePaginate($this->limit);
        return view('index', compact('posts', 'categories'));
    }

}
