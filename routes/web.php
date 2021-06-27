<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'HomeController@index')->name('home');

Route::get('invoice', function(){
    return view('invoice');
});

Route::get('{path}', "HomeController@index")->where('path', '([A-z\d\-\/_.]+)?' );

Route::get('usulan', "UsulanController@index");

Route::get('usulan_admin', "UsulanController@index_admin");

Route::post('panduan',"PanduanController@index");

// Route::get('files', 'PanduanController@index');
// Route::post('upload', 'PanduanController@uploadFile');
// Route::get('delete/upload-folder/{file}', 'PanduanController@deleteFile');
// Route::get('download/upload-folder/{file}', 'PanduanController@downloadFile');
// Route::get('download/usulan/{file}', 'API\UsulanController@downloadFile');

