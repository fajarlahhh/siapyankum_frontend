<?php

use Spatie\Permission\Models\Role;
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



Route::group(['middleware' => ['auth']], function () {
	Route::get('/', 'DashboardController@index');
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
    Route::get('/gantisandi', 'PenggunaController@ganti_sandi')->name('gantisandi');

    Route::group(['middleware' => ['role_or_permission:administrator|pengguna']], function () {
		Route::get('/pengguna', 'PenggunaController@index')->name('pengguna');
		Route::get('/pengguna/edit/{id}', 'PenggunaController@edit')->middleware(['role:administrator|user']);
		Route::put('/pengguna/edit', 'PenggunaController@do_edit')->middleware(['role:administrator|user'])->name('pengguna.edit');
		Route::get('/pengguna/tambah', 'PenggunaController@tambah')->middleware(['role:administrator|user'])->name('pengguna.tambah');
		Route::post('/pengguna/tambah', 'PenggunaController@do_tambah')->middleware(['role:administrator|user']);
		Route::delete('/pengguna/hapus/{id}', 'PenggunaController@hapus')->middleware(['role:administrator|user']);
	});


    Route::group(['middleware' => ['role_or_permission:administrator|jenisperaturan']], function () {
        Route::prefix('jenisperaturan')->group(function () {
            Route::get('/', 'JenisperaturanController@index')->name('jenisperaturan');
            Route::get('edit/{id}', 'JenisperaturanController@edit')->middleware(['role:administrator|user']);
            Route::put('edit', 'JenisperaturanController@do_edit')->middleware(['role:administrator|user'])->name('jenisperaturan.edit');
            Route::get('tambah', 'JenisperaturanController@tambah')->middleware(['role:administrator|user'])->name('jenisperaturan.tambah');
            Route::post('tambah', 'JenisperaturanController@do_tambah')->middleware(['role:administrator|user']);
            Route::patch('hapus/{id}', 'JenisperaturanController@hapus')->middleware(['role:administrator|user']);
            Route::patch('restore/{id}', 'JenisperaturanController@restore')->middleware(['role:administrator|user']);
            Route::delete('hapuspermanen/{id}', 'JenisperaturanController@hapus_permanen')->middleware(['role:administrator|user']);
        });
    });

    Route::group(['middleware' => ['role_or_permission:administrator|dataperaturan']], function () {
		Route::get('/dataperaturan', 'PeraturanController@index')->name('dataperaturan');
		Route::get('/dataperaturan/edit/{id}', 'PeraturanController@edit')->middleware(['role:administrator|user']);
		Route::put('/dataperaturan/edit', 'PeraturanController@do_edit')->middleware(['role:administrator|user'])->name('dataperaturan.edit');
		Route::get('/dataperaturan/tambah', 'PeraturanController@tambah')->middleware(['role:administrator|user'])->name('dataperaturan.tambah');
		Route::post('/dataperaturan/tambah', 'PeraturanController@do_tambah')->middleware(['role:administrator|user']);
		Route::delete('/dataperaturan/hapus/{id}', 'PeraturanController@hapus')->middleware(['role:administrator|user']);
	});

    Route::group(['middleware' => ['role_or_permission:administrator|datalensakegiatan']], function () {
		Route::get('/datalensakegiatan', 'LensakegiatanController@index')->name('datalensakegiatan');
		Route::get('/datalensakegiatan/edit/{id}', 'LensakegiatanController@edit')->middleware(['role:administrator|user']);
		Route::put('/datalensakegiatan/edit', 'LensakegiatanController@do_edit')->middleware(['role:administrator|user'])->name('datalensakegiatan.edit');
		Route::get('/datalensakegiatan/tambah', 'LensakegiatanController@tambah')->middleware(['role:administrator|user'])->name('datalensakegiatan.tambah');
		Route::post('/datalensakegiatan/tambah', 'LensakegiatanController@do_tambah')->middleware(['role:administrator|user']);
		Route::delete('/datalensakegiatan/hapus/{id}', 'LensakegiatanController@hapus')->middleware(['role:administrator|user']);
    });

    Route::group(['middleware' => ['role_or_permission:administrator|pendapatsaranhukum']], function () {
		Route::get('/pendapatsaranhukum', 'PendapatsaranhukumController@index')->name('pendapatsaranhukum');
		Route::get('/pendapatsaranhukum/edit/{id}', 'PendapatsaranhukumController@edit')->middleware(['role:administrator|user']);
		Route::put('/pendapatsaranhukum/edit', 'PendapatsaranhukumController@do_edit')->middleware(['role:administrator|user'])->name('pendapatsaranhukum.edit');
		Route::get('/pendapatsaranhukum/tambah', 'PendapatsaranhukumController@tambah')->middleware(['role:administrator|user'])->name('pendapatsaranhukum.tambah');
		Route::post('/pendapatsaranhukum/tambah', 'PendapatsaranhukumController@do_tambah')->middleware(['role:administrator|user']);
		Route::get('/pendapatsaranhukum/proses/{id}', 'PendapatsaranhukumController@proses')->middleware(['role:administrator|user']);
		Route::post('/pendapatsaranhukum/proses', 'PendapatsaranhukumController@do_proses')->middleware(['role:administrator|user'])->name('pendapatsaranhukum.proses');
		Route::delete('/pendapatsaranhukum/hapus/{id}', 'PendapatsaranhukumController@hapus')->middleware(['role:administrator|user']);
		Route::delete('/pendapatsaranhukum/hapusproses/{id}/{status}/{tanggal}', 'PendapatsaranhukumController@hapus_proses')->middleware(['role:administrator|user']);
	});

    Route::group(['middleware' => ['role_or_permission:administrator|praperadilan']], function () {
		Route::get('/praperadilan', 'PraperadilanController@index')->name('praperadilan');
		Route::get('/praperadilan/edit/{id}', 'PraperadilanController@edit')->middleware(['role:administrator|user']);
		Route::put('/praperadilan/edit', 'PraperadilanController@do_edit')->middleware(['role:administrator|user'])->name('praperadilan.edit');
		Route::get('/praperadilan/tambah', 'PraperadilanController@tambah')->middleware(['role:administrator|user'])->name('praperadilan.tambah');
		Route::post('/praperadilan/tambah', 'PraperadilanController@do_tambah')->middleware(['role:administrator|user']);
		Route::get('/praperadilan/proses/{id}', 'PraperadilanController@proses')->middleware(['role:administrator|user']);
		Route::post('/praperadilan/proses', 'PraperadilanController@do_proses')->middleware(['role:administrator|user'])->name('praperadilan.proses');
		Route::delete('/praperadilan/hapus/{id}', 'PraperadilanController@hapus')->middleware(['role:administrator|user']);
		Route::delete('/praperadilan/hapusproses/{id}/{status}/{tanggal}', 'PraperadilanController@hapus_proses')->middleware(['role:administrator|user']);
	});

    Route::group(['middleware' => ['role_or_permission:administrator|pidana']], function () {
		Route::get('/pidana', 'PidanaController@index')->name('pidana');
		Route::get('/pidana/edit/{id}', 'PidanaController@edit')->middleware(['role:administrator|user']);
		Route::put('/pidana/edit', 'PidanaController@do_edit')->middleware(['role:administrator|user'])->name('pidana.edit');
		Route::get('/pidana/tambah', 'PidanaController@tambah')->middleware(['role:administrator|user'])->name('pidana.tambah');
		Route::post('/pidana/tambah', 'PidanaController@do_tambah')->middleware(['role:administrator|user']);
		Route::get('/pidana/proses/{id}', 'PidanaController@proses')->middleware(['role:administrator|user']);
		Route::post('/pidana/proses', 'PidanaController@do_proses')->middleware(['role:administrator|user'])->name('pidana.proses');
		Route::delete('/pidana/hapus/{id}', 'PidanaController@hapus')->middleware(['role:administrator|user']);
		Route::delete('/pidana/hapusproses/{id}/{status}/{tanggal}', 'PidanaController@hapus_proses')->middleware(['role:administrator|user']);
	});

    Route::group(['middleware' => ['role_or_permission:administrator|perdata']], function () {
		Route::get('/perdata', 'PerdataController@index')->name('perdata');
		Route::get('/perdata/edit/{id}', 'PerdataController@edit')->middleware(['role:administrator|user']);
		Route::put('/perdata/edit', 'PerdataController@do_edit')->middleware(['role:administrator|user'])->name('perdata.edit');
		Route::get('/perdata/tambah', 'PerdataController@tambah')->middleware(['role:administrator|user'])->name('perdata.tambah');
		Route::post('/perdata/tambah', 'PerdataController@do_tambah')->middleware(['role:administrator|user']);
		Route::get('/perdata/proses/{id}', 'PerdataController@proses')->middleware(['role:administrator|user']);
		Route::post('/perdata/proses', 'PerdataController@do_proses')->middleware(['role:administrator|user'])->name('perdata.proses');
		Route::delete('/perdata/hapus/{id}', 'PerdataController@hapus')->middleware(['role:administrator|user']);
		Route::delete('/perdata/hapusproses/{id}/{status}/{tanggal}', 'PerdataController@hapus_proses')->middleware(['role:administrator|user']);
	});

    Route::group(['middleware' => ['role_or_permission:administrator|ptun']], function () {
		Route::get('/ptun', 'PtunController@index')->name('ptun');
		Route::get('/ptun/edit/{id}', 'PtunController@edit')->middleware(['role:administrator|user']);
		Route::put('/ptun/edit', 'PtunController@do_edit')->middleware(['role:administrator|user'])->name('ptun.edit');
		Route::get('/ptun/tambah', 'PtunController@tambah')->middleware(['role:administrator|user'])->name('ptun.tambah');
		Route::post('/ptun/tambah', 'PtunController@do_tambah')->middleware(['role:administrator|user']);
		Route::get('/ptun/proses/{id}', 'PtunController@proses')->middleware(['role:administrator|user']);
		Route::post('/ptun/proses', 'PtunController@do_proses')->middleware(['role:administrator|user'])->name('ptun.proses');
		Route::delete('/ptun/hapus/{id}', 'PtunController@hapus')->middleware(['role:administrator|user']);
		Route::delete('/ptun/hapusproses/{id}/{status}/{tanggal}', 'PtunController@hapus_proses')->middleware(['role:administrator|user']);
	});

    Route::group(['middleware' => ['role_or_permission:administrator|agama']], function () {
		Route::get('/agama', 'AgamaController@index')->name('agama');
		Route::get('/agama/edit/{id}', 'AgamaController@edit')->middleware(['role:administrator|user']);
		Route::put('/agama/edit', 'AgamaController@do_edit')->middleware(['role:administrator|user'])->name('agama.edit');
		Route::get('/agama/tambah', 'AgamaController@tambah')->middleware(['role:administrator|user'])->name('agama.tambah');
		Route::post('/agama/tambah', 'AgamaController@do_tambah')->middleware(['role:administrator|user']);
		Route::get('/agama/proses/{id}', 'AgamaController@proses')->middleware(['role:administrator|user']);
		Route::post('/agama/proses', 'AgamaController@do_proses')->middleware(['role:administrator|user'])->name('agama.proses');
		Route::delete('/agama/hapus/{id}', 'AgamaController@hapus')->middleware(['role:administrator|user']);
		Route::delete('/agama/hapusproses/{id}/{status}/{tanggal}', 'AgamaController@hapus_proses')->middleware(['role:administrator|user']);
	});

	Route::prefix('konsultasihukum')->group(function () {
		Route::get('/', 'KonsultasihukumController@index');
		Route::get('/pesan/{penerima}/{pengirim}', 'KonsultasihukumController@terimaPesan')->name('pesan');
		Route::post('pesan', 'KonsultasihukumController@kirimPesan');
		Route::get('/hapusaktif/{id}', 'KonsultasihukumController@hapusAktif')->name('hapusaktif');
		Route::get('/detailaktif', 'KonsultasihukumController@getAktif')->name('detailaktif');
	});

	Route::prefix('daftarkonsultasihukum')->group(function () {
		Route::get('/', 'KonsultasihukumController@laporan');
		Route::post('/cetak', 'KonsultasihukumController@cetak');
	});
});

Route::prefix('frontend')->group(function () {
	Route::get('/', 'HomeController@index');

	Route::prefix('konsultasihukum')->group(function () {
		Route::get('/', 'KonsultasihukumController@member');
		Route::get('/login', 'LoginmemberController@showLoginForm')->name('konsultasilogin');
		Route::post('/login', 'LoginmemberController@login');
		Route::get('/logout', 'LoginmemberController@logout')->name('konsultasilogout');
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
	});

	Route::prefix('lensakegiatan')->group(function () {
		Route::get('/', 'HomeController@lensakegiatan');
		Route::get('/{id}', 'HomeController@lensakegiatan_tampil');
	});

	Route::prefix('pendapatsaran')->group(function () {
		Route::get('/', 'HomeController@pendapatsaran');
		Route::get('/{id}', 'HomeController@pendapatsaran_tampil');
	});
});

Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@login');

Route::get('/logout', 'Auth\LoginController@logout');
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
