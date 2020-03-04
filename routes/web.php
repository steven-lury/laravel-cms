<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'PostsController@index')->name('home');
Route::get('/post/{post}', 'PostsController@show')->name('post.show');
Route::get('/category/{category}', 'PostsController@category')->name('category');
Route::get('/user/{user}', 'PostsController@user')->name('user.post');

Auth::routes();

Route::get('/blog', 'HomeController@index')->name('default');

/**
 * Admin Dashboard Controller
 */
Route::get('/dashboard', 'Admin\DashboardsController@index')->name('dashboard.home');
Route::resource('admin/post', 'Admin\PostsController');
