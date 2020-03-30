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
Route::get('/posts/{posts}', 'PostsController@show')->name('post.show');
Route::get('/category/{category}', 'PostsController@category')->name('category');
Route::get('/user/{user}', 'PostsController@user')->name('user.post');

Auth::routes();

Route::get('/blog', 'HomeController@index')->name('default');

/**
 * Admin Dashboard Controller
 */
Route::get('/dashboard', 'Admin\DashboardsController@index')->name('dashboard.home');

Route::group(
    ['as' => 'admin.', 'prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['auth']],
    function (){
        Route::resource('post', 'PostsController');
        Route::put('post/restore/{post}', 'PostsController@restore')->name('post.restore');
        Route::delete('post/force-destroy/{post}', 'PostsController@forceDestroy')->name('post.force-destroy');
    }
);

