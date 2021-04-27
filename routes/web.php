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

/*PAGE INIT*/
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/master/provinsi', 'MasterController@provinsi_index')->name('master.provinsi');
Route::get('/master/pelanggan', 'MasterController@pelanggan_index')->name('master.pelanggan');
Route::get('/master/produk', 'MasterController@produk_index')->name('master.produk');
/*PAGE INIT*/

/*MODAL FORM*/
Route::get('/master/ukuran/form', 'MasterController@form_ukuran')->name('modal.master.ukuran');
Route::get('/master/warna/form', 'MasterController@form_warna')->name('modal.master.warna');
Route::get('/master/kategori/form', 'MasterController@form_kategori')->name('modal.master.kategori');
Route::get('/master/produk/form', 'MasterController@form_produk')->name('modal.master.produk');
/*MODAL FORM*/
