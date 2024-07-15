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
Route::get('/login', 'Auth\LoginController@login')->name('login');
Route::post('/login', 'Auth\LoginController@login');

Route::get('/register', 'Auth\RegisterController@register')->name('register');
Route::post('/register', 'Auth\RegisterController@register');

Route::get('/added', 'Auth\RegisterController@added')->name('added');
Route::post('/added', 'Auth\RegisterController@added');

//ログイン中のみ表示可能なページはここ
Route::group(['middleware' => ['auth']], function(){
Route::get('/top','PostsController@index')->name('top'); //トップページ
Route::post('/top','PostsController@index');

//投稿作成
Route::post('/post/create','PostsController@store')->name('posts.store');
Route::post('/post/update','PostsController@update')->name('posts.update');
Route::post('/post/delete','PostsController@delete')->name('posts.delete');


Route::get('/profile','UsersController@profile')->name('profile'); //プロフィール編集ページへ
Route::get('/search','UsersController@search')->name('search'); //ユーザー検索ページへ
Route::get('/followList','FollowsController@followList')->name('followList'); //フォローリストページへ
Route::get('/followerList', 'FollowsController@followerList')->name('followerList'); //フォロワーリストページへ

});

Route::get('/logout','Auth\LoginController@logout')->name('logout'); //ログアウト
