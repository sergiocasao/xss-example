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

Auth::routes();

Route::get('/cuidado', 'HomeController@cuidado')->name('cuidado');

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/status', 'StatusController@store')->name('status.create');

Route::get('/search/{q?}', 'HomeController@search')->name('search');

Route::post('/follow', 'UserController@follow')->name('follow');

Route::group(['middleware' => 'auth', 'prefix' => 'status/{status}'], function () {

    Route::post('/love', 'StatusController@love')->name('love');

    Route::post('/comment', 'CommentController@store')->name('status.comment.store');

});
