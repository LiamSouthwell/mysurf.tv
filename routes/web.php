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

Route::get('/', 'VideoController@index');
Route::post('/thumbnail', 'VideoController@thumbnail');
Route::get('/watch/{videoID}', 'VideoController@watch');
Route::post('/search', 'VideoController@search');
Route::get('/fetchtrending', 'VideoController@getTrending');

Route::get('/searchPlaylists', 'VideoController@searchPlaylists');
Route::post('/searchPlaylist', 'VideoController@searchPlaylist');
Route::post('/fetchrelated', 'VideoController@getRelated');
Route::get('/fetchrecent', 'VideoController@getRecent');

Route::get('/fetchuserplaylists', 'UserPlaylistController@fetch');
Route::post('/adduserplaylist', 'UserPlaylistController@store');



Route::get('/tester', 'VideoController@tester');
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::get('/test', function () {
    return view('test');
});

Route::get('/latest', function () {
    return view('latest');
});

Route::get('/trending', function () {
    return view('trending');
});

Auth::routes();

Route::get('/home', 'VideoController@index');
Route::get('/getUser', 'VideoController@getUser');
Route::middleware('admin')->group(function () {
	Route::get('/playlists', 'PlaylistController@index');
	Route::get('/playlists/create', 'PlaylistController@create');
	Route::post('/playlists/store', 'PlaylistController@store');
	Route::get('/playlists/edit/{id}', 'PlaylistController@edit');
	Route::post('/playlists/update/{id}', 'PlaylistController@update');
	Route::get('/playlists/delete/{id}', 'PlaylistController@delete');
});
