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

Route::get('/', 'PostsController@index');

// create: 新規作成用のフォームページ
Route::get('posts/create', 'PostsController@create')->name('posts.create');
// store: 投稿処理
Route::post('posts/create', 'PostsController@store')->name('posts.store');
// edit: 編集用のフォームページ
Route::get('posts/edit/{id}', 'PostsController@edit')->name('posts.edit');
// update: 更新処理
Route::put('posts/edit/{id}', 'PostsController@update')->name('posts.update');
// destroy: 削除処理
Route::delete('posts/{id}', 'PostsController@destroy')->name('posts.destroy');

// ユーザ登録
Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup.get');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');

// ログイン認証
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');

// ユーザ機能
Route::group(['middleware' => ['auth']], function () {
    Route::resource('users', 'UsersController', ['only' => ['index', 'show']]);
});