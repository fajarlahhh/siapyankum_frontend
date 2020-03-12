<?php

use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Redirect;
use Spatie\Permission\Models\Permission;

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



	Route::get('/', 'HomeController@index');

	Route::prefix('konsultasihukum')->group(function () {
		Route::get('/', 'KonsultasihukumController@member');
		Route::get('/login', 'LoginmemberController@showLoginForm')->name('konsultasilogin');
		Route::post('/login', 'LoginmemberController@login');
		Route::post('/logout', 'LoginmemberController@logout')->name('konsultasilogout');
		Route::get('/pesan/{penerima}/{pengirim}', 'KonsultasihukumController@terimaPesan')->name('pesan');
		Route::post('pesan', 'KonsultasihukumController@kirimPesan');
		Route::get('/tambahaktif/{id}', 'KonsultasihukumController@tambahAktif')->name('tambahaktif');
	});

	Route::prefix('bantuanhukum')->group(function () {
		Route::get('/', 'HomeController@bantuanhukum');
		Route::get('/{jenis}', 'HomeController@bantuanhukum_list');
		Route::get('/{jenis}/{id}', 'HomeController@bantuanhukum_tampil');
	});

	Route::prefix('peraturan')->group(function () {
		Route::get('/', 'HomeController@peraturan');
		Route::get('/{jenis}', 'HomeController@peraturan_list');
		Route::get('/tampil/{jenis}/{id}', 'HomeController@peraturan_tampil');
		Route::get('/download/{id}', 'HomeController@peraturan_download');
	});

	Route::prefix('lensakegiatan')->group(function () {
		Route::get('/', 'HomeController@lensakegiatan');
		Route::get('/{id}', 'HomeController@lensakegiatan_tampil');
		Route::get('/download/{id}', 'HomeController@lensakegiatan_download');
	});

	Route::prefix('pendapatsaran')->group(function () {
		Route::get('/', 'HomeController@pendapatsaran');
		Route::get('/{id}', 'HomeController@pendapatsaran_tampil');
	});