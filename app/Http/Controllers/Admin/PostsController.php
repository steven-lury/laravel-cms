<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
    public function index(Request $request)
    {
        $trash     = FALSE;
        if(($status = $request->get('status')) && $status == 'trash'){
            $posts     = Post::onlyTrashed()->with('category', 'user')->latest()->paginate($this->limit);
            $postCount = Post::onlyTrashed()->count();
            $trash     = TRUE;
        }elseif($status == 'schedule'){
            $posts     = Post::schedule()->with('category', 'user')->latest()->paginate($this->limit);
            $postCount = Post::schedule()->count();

        }elseif($status == 'draft'){
            $posts     = Post::draft()->with('category', 'user')->latest()->paginate($this->limit);
            $postCount = Post::draft()->count();

        }elseif($status == 'published'){
            $posts     = Post::published()->with('category', 'user')->latest()->paginate($this->limit);
            $postCount = Post::published()->count();

        }else{
            $posts = Post::with('category', 'user')->latest()->paginate($this->limit);
            $postCount = Post::count();
        }
        $itemCount = $this->countStatus();

        return view('backend.posts.index', compact('posts', 'postCount', 'trash', 'itemCount'));
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
        Post::findOrFail($id)->delete();
        return redirect()->route('admin.post.index')->with('trashMsg', ['Your Post Was Successfully Deleted', $id]);
    }

    public function forceDestroy($id)
    {
        Post::onlyTrashed()->findOrFail($id)->forceDelete();
        return redirect()->route('admin.post.index', ['status' => 'trash'])->with('successMsg', 'Your post was permanetly deleted for ever');
    }

    /**
     * Restore deleted posts from trash
     */
    public function restore($id)
    {
        $post = Post::onlyTrashed()->findOrFail($id);
        $post->restore();
        return redirect()->route('admin.post.index')->with('successMsg', "{$post->title} was successfully restore from trash");
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

    public function countStatus()
    {
        return [
            'all'       => Post::count(),
            'schedule'  => Post::schedule()->count(),
            'published' => Post::published()->count(),
            'draft'     => Post::draft()->count(),
            'trash'     => Post::onlyTrashed()->count(),
        ];
    }
}
