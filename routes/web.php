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


Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/','HomeController@index')->name('home');
Route::resource('level','LevelController');
Route::resource('user','UserController');
Route::resource('kota','KotaController');
Route::resource('supplier','SupplierController');
Route::resource('kategori','KategoriController');
Route::resource('ruang','RuangController');
Route::resource('inventaris','InventarisController');
Route::resource('masuk','MasukController');
Route::resource('keluar','KeluarController');
Route::resource('pinjam','PinjamController');
