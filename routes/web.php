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
Route::post('/thumbnail', 'VideoController@thumbnail');
Route::get('/watch/{videoID}', 'VideoController@watch');
Route::post('/search', 'VideoController@search');

Route::get('/searchPlaylists', 'VideoController@searchPlaylists');


Route::get('/test', function () {
    return view('test');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware('admin')->group(function () {
	Route::get('/playlists', 'PlaylistController@index');
	Route::get('/playlists/create', 'PlaylistController@create');
	Route::post('/playlists/store', 'PlaylistController@store');
	Route::get('/playlists/edit/{id}', 'PlaylistController@edit');
	Route::post('/playlists/update/{id}', 'PlaylistController@update');
	Route::get('/playlists/delete/{id}', 'PlaylistController@delete');
});
