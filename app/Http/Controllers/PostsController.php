<?php

namespace App\Http\Controllers;

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

    public function show($id){

        $post = Post::findOrFail($id);
        return view('show', compact('post'));

    }

}
