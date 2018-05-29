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

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
    Route::get('files', 'FileEntriesController@index');
    Route::get('files/create', 'FileEntriesController@create');
    Route::post('files/upload-file', 'FileEntriesController@uploadFile');

    Route::get('files/{path_file}/{file}', function($path_file = null, $file = null) {
        $path = storage_path().'/files/uploads/'.$path_file.'/'.$file;
        if(file_exists($path)) {
            return Response::download($path);
        }
    });
});


