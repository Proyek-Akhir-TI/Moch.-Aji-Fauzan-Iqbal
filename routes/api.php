<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->get('/usulanDosen', function (Request $request) {
    return $request->usulanDosen();
});

Route::apiResources(['user' => 'API\UserController']);
Route::get('reviewer','API\ReviewerController@index_reviewer');
Route::get('profile', 'API\UserController@profile');
// Route::get('reviewer', 'API\UserController@reviewer');
Route::get('findUser', 'API\UserController@search');
Route::put('profile', 'API\UserController@updateProfile');
Route::put('update_password', 'API\UserController@updatePassword');
Route::get('usulan_dosen', 'API\UsulanController@index');
Route::get('usulan_admin', 'API\UsulanController@index_admin');
Route::get('usulan_diterima', 'API\UsulanController@index_diterima');

Route::get('kategori', 'API\KategoriController@index');

Route::get('download/usulan/{file}', 'API\UsulanController@downloadFile');

Route::apiResources(['usulan' => 'API\UsulanController',
                    'usulanDosen'=> 'API\DosenController',
                    'usulanReviewer'=> 'API\ReviewerController']);

Route::apiResources(['panduan' => 'API\PanduanController']);
Route::get('download/panduan/{berkas}', 'API\UsulanController@downloadPanduan');
