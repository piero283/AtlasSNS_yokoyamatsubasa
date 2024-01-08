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

// Route::get('/'index, function () {
//     return view('index');
// });
// Route::get('/home', 'HomeController@index')->name('home');

//Auth::routes();


//ログアウト中のページ
Route::get('/login', 'Auth\LoginController@login');
Route::post('/login', 'Auth\LoginController@login');

Route::get('/register', 'Auth\RegisterController@register');
Route::post('/register', 'Auth\RegisterController@register');

Route::get('/added', 'Auth\RegisterController@added');
Route::post('/added', 'Auth\RegisterController@added');

Route::post('/top','PostsController@index');

//ログイン中のみ表示可能なページはここ
//
//Route::group(['middleware' => 'auth'], function(){
  //ログイン中のページ
Route::get('/top','PostsController@index');

Route::get('/profile','UsersController@profile');
//
Route::get('/logout','Auth\LoginController@login');

Route::get('/search','UsersController@search');

Route::get('/followList','FollowsController@followList');

Route::get('/followerList','FollowsController@followerList');


//});
