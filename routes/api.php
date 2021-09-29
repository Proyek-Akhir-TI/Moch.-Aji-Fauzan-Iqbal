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
Route::apiResources(['kategori' => 'API\KategoriController']);
Route::get('reviewer/{id}','API\ReviewerController@index_reviewer');
Route::get('profile', 'API\UserController@profile');
// Route::get('reviewer', 'API\UserController@reviewer');
Route::get('findUser', 'API\UserController@search');
Route::put('profile', 'API\UserController@updateProfile');
Route::put('profilepassword', 'API\UserController@updateProfilePassword');
Route::put('update_password', 'API\UserController@updatePassword');
Route::get('usulan_dosen', 'API\DosenController@index_status');
Route::get('usulan_admin', 'API\UsulanController@index_admin');
Route::get('usulan_admin_status', 'API\UsulanController@index_admin_status');
Route::get('usulan_diterima', 'API\UsulanController@index_diterima');

Route::get('filter_tanggal/{id}', 'API\UsulanController@index_tanggal');
Route::get('filter_status/{id}', 'API\UsulanController@index_status');
Route::get('filter_kategori/{id}', 'API\UsulanController@index_kategori');
Route::get('filter_judul/{id}', 'API\UsulanController@index_judul');
Route::get('filter_range/{id}', 'API\UsulanController@index_range');

Route::get('dosen_tanggal/{id}', 'API\DosenController@index_tanggal');
Route::get('dosen_status/{id}', 'API\DosenController@index_statuses');
Route::get('dosen_kategori/{id}', 'API\DosenController@index_kategori');
Route::get('dosen_judul/{id}', 'API\DosenController@index_judul');

Route::get('kategori', 'API\KategoriController@index');
Route::get('filedownload/{file}', 'API\FileDownloadController@download');
Route::get('fileupload/{id}', 'API\DosenController@fileupload');
Route::get('fileuploadreviewer/{id}', 'API\ReviewerController@fileupload');
Route::get('getfileuploadreviewer/{id}', 'API\ReviewerController@getfileuploadReviewer');
Route::get('getliststatus/{id}', 'API\UsulanController@getListStatus');

Route::get('download/usulan/{file}', 'API\UsulanController@downloadFile');

// Route::get('download','API\UsulanController@downloadFile');
// Route::get('download', 'API/FileDownloadController@index');

Route::apiResources(['usulan' => 'API\UsulanController',
                    'usulanDosen'=> 'API\DosenController',
                    'usulanReviewer'=> 'API\ReviewerController']);
Route::put('updateusulan/{id}','API\DosenController@update');
Route::put('updateusulanreviewer/{id}','API\ReviewerController@update');

Route::apiResources(['panduan' => 'API\PanduanController']);
Route::get('downloadpanduan/{file}', 'API\PanduanController@downloadPanduan');
Route::get('list_reviewer/{id}','API\ReviewerController@get_reviewer');
Route::get('list_reviewer_nilai/{id}','API\ReviewerController@get_reviewer_nilai');
Route::get('list_catatan/{id}','API\DosenController@get_catatan');


Route::get('getkriteria', 'API\KriteriaController@get');




// Iki new
Route::get('prodi','API\prodiController@index');


Route::get('jumlahusulan','API\UsulanController@jumlahUsulan');
Route::get('jumlahusulanbar','API\UsulanController@jumlahUsulanBar');
Route::get('jumlahusulanpie','API\UsulanController@jumlahUsulanPie');

Route::get('kirim-email', 'EmailController@index');