<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Post;
use App\User;

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

        if(!session('view_post_'.$post->title)){
            $post->increment('view_count');
            session(['view_post_'.$post->title => 1]);
        }
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

    public function user(User $user)
    {
        $posts = $user->posts()->published()->simplePaginate($this->limit);
        return view('index', compact('posts'));
    }

}
