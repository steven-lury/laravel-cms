<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\User;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::latest()->paginate(10);
        $UsersCount = User::count();
        return view('backend.users.index', compact('users', 'UsersCount'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $user = $request->all();
        $user['slug'] = str_slug($request->name);
        User::create($user);
        return redirect()->route('admin.user.index')->with('successMsg', 'The User Was Created Successfully!');
    }

    /**
     *
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
        $user = User::findOrFail($id);
        return view('backend.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->all());
        return redirect()->route('admin.user.index')->with('successMsg', "{$user->name} Info Was Successfully Updated!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $action = $request->action;
        $assignUser = intval($request->users);
        if($action == 'all'){
            //delete all post
            $posts = $user->posts;
            $directory = config("cms.image.directory");
            $imagePath = public_path($directory);
            foreach($posts as $post){
                if(file_exists($imagePath.'/'.$post->image)){
                    $extension = substr($post->image, strrpos($post->image, '.')+1);
                    $thumb = str_replace(".{$extension}", "_thumb.{$extension}", $post->image );
                    unlink($imagePath.'/'.$post->image);
                    if(file_exists($imagePath.'/'.$thumb)){
                        unlink($imagePath.'/'.$thumb);
                    }
                }
            }
            $user->posts()->withTrashed()->forceDelete();
        }elseif($action == 'user'){
            //assign to the specified user
            $user->posts()->update(['user_id' => $assignUser]);
        }
        $user->delete();
        return redirect()->route('admin.user.index')->with('successMsg', "{$user->name} Was Successfully Removed");
    }

    public function confirm($id)
    {
        $user = User::findOrfail($id);
        $users = User::where('id', '!=', $id)->pluck('name', 'id');
        return view('backend.users.confirm', compact('user', 'users'));
    }

    public function removeImageUserPost()
    {
        $posts = User::posts();

    }
}
