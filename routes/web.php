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

//ログアウト中のページ
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@login');

Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('/register', 'Auth\RegisterController@register');

Route::get('/added', 'Auth\RegisterController@added')->name('added');
Route::post('/added', 'Auth\RegisterController@added');

//ログイン中のみ表示可能なページはここ
Route::group(['middleware' => ['loginCheck']], function(){
Route::get('/top','PostsController@index')->name('top'); //トップページ
Route::post('/top','PostsController@index');

//投稿作成？以前書いて忘れたので後ほど復習
Route::get('/post/create', 'PostsController@create')->name('post.create');
Route::get('/posts', 'PostsController@store')->name('posts.store');
//投稿一覧
Route::get('post/create','PostsController@posts')->name('posts.index');

Route::get('/profile','UsersController@profile')->name('profile'); //プロフィール編集ページへ
Route::get('/search','UsersController@search')->name('search'); //ユーザー検索ページへ
Route::get('/followList','FollowsController@followList')->name('followList'); //フォローリストページへ
Route::get('/followerList', 'FollowsController@followerList')->name('followerList'); //フォロワーリストページへ

});

Route::get('/logout','Auth\LoginController@showLoginForm')->name('logout'); //ログアウト
