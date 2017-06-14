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

Route::get('/test', function() {
    Storage::disk('google')->put('test.txt', 'Hello World');
});

Route::post('/upload', 'HandlerController@upload_file');

Auth::routes();

Route::get('/home', 'HomeController@index');
