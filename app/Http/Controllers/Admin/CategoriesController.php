<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use App\Post;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\CategoryDeleteRequest;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::with('posts')->orderBy('title', 'DESC')->paginate();
        $CategoryCount = Category::count();
        return view('backend.categories.index', compact('categories', 'CategoryCount'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $category = Category::create($request->all());
        return redirect()->route('admin.category.index')->with('successMsg', 'Your Category Was Created Successfully!');
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
        $category = Category::findOrFail($id);
        return view('backend.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->update($request->all());
        return redirect()->route('admin.category.index')->with('successMsg', 'Your Category Was Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(CategoryDeleteRequest $request , $id)
    {
        $category = Category::findOrFail($id);
        Post::where('category_id', $id)->update(['category_id' => config('cms.DEFAULT_CAT_ID')]);
        $category->delete();
        return redirect()->route('admin.category.index')->with('successMsg', "{$category->title} Was Successfully Deleted Permanently");
    }
}
