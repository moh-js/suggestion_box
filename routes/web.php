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

Auth::routes(['register' => false]);

Route::get('/', 'HomeController@index')->name('home');
Route::get('/my-posts', 'HomeController@myPosts')->name('my.post');
Route::get('/public-posts', 'HomeController@publicPosts')->name('public.post');

Route::resource('category', 'CategoryController')->except([
    'show'
])
->middleware('role:super-admin|admin');

Route::resource('user', 'UsersController')->except([
    'show'
])
->middleware('role:super-admin|admin');

Route::resource('post', 'PostController')->except([

]);

Route::post('comment/{post}', 'CommentController@postComment')->name('post.comment');
