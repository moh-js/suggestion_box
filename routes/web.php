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

Route::resource('category', 'CategoryController')->except([
    'show'
]);

Route::resource('user', 'UsersController')->except([
    'show'
]);

Route::resource('post', 'PostController')->except([

]);

Route::post('comment/{post}', 'CommentController@postComment')->name('post.comment');
