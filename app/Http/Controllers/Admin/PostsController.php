<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Post;
use Intervention\Image\Facades\Image;

class PostsController extends Controller
{
    private $limit = 4;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with('category', 'user')->latest()->paginate($this->limit);
        $postCount = Post::all()->count();
        return view('backend.posts.index', compact('posts', 'postCount'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $data = $this->handleRequest($request);
        $request->user()->posts()->create($data);
        return redirect()->route('admin.post.index')->with('successMsg', 'Post is successfully added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('backend.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, $id)
    {
        $post = Post::findOrFail($id);
        $data = $this->handleRequest($request);
        $post->update($data);
        return redirect()->route('admin.post.index')->with('successMsg', "{$post->title} Updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function handleRequest($request)
    {
        $data = $request->all();
        if($request->hasFile('image')){
            $directory = config('cms.image.directory');
            $width = config('cms.image.thumb.width');
            $height = config('cms.image.thumb.height');
            $image       = $request->file('image');
            $fileName    = $image->getClientOriginalName();
            $destination = public_path($directory).'/';
            $successUpload = $image->move($destination, $fileName);
            if($successUpload){
                $extension = $image->getClientOriginalExtension();
                $thumb = str_replace(".{$extension}", "_thumb.{$extension}", $fileName );
                Image::make($destination.'/'.$fileName)->resize($width, $height)->save($destination.'/'.$thumb);

            }
            $data['image'] = $fileName;
        }
        return $data;
    }
}
