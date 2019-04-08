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
Route::get('/searchvideo', 'VideoController@search');
Route::get('/test', function () {
    return view('test');
});
