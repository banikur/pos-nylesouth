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
Route::post('/storeMedia', 'VerifiedController@storeMedia')->name('projects.storeMedia');
Route::post('/dropzoneRemove', 'VerifiedController@dropzoneRemove')->name('projects.dropzoneRemove');

Auth::routes();

/*PAGE INIT*/
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/master/provinsi', 'MasterController@provinsi_index')->name('master.provinsi');
Route::get('/master/pelanggan', 'MasterController@pelanggan_index')->name('master.pelanggan');
Route::get('/master/produk', 'MasterController@produk_index')->name('master.produk');

/*TRANSAKSI*/
Route::get('/master/daftar-pesanan', 'TransaksiController@pemesanan_index')->name('master.pemesanan');
Route::get('/master/retur-barang', 'TransaksiController@retur_index')->name('master.retur');

/*TRANSAKSI*/

/*PAGE INIT*/

/*MODAL FORM*/
Route::get('/master/ukuran/form', 'MasterController@form_ukuran')->name('modal.master.ukuran');
Route::get('/master/warna/form', 'MasterController@form_warna')->name('modal.master.warna');
Route::get('/master/kategori/form', 'MasterController@form_kategori')->name('modal.master.kategori');
Route::get('/master/produk/form', 'MasterController@form_produk')->name('modal.master.produk');

Route::get('/master/produk/detail', 'MasterController@detail_produk')->name('modal.detail_produk');

Route::post('/master/produk/s_warna', 'MasterController@post_warna')->name('produk.s_warna');
Route::post('/master/produk/u_warna', 'MasterController@post_warna')->name('produk.u_warna');
Route::post('/master/produk/s_ukuran', 'MasterController@post_ukuran')->name('produk.s_ukuran');
Route::post('/master/produk/u_ukuran', 'MasterController@post_ukuran')->name('produk.u_ukuran');
Route::post('/master/produk/s_kategori', 'MasterController@post_kategori')->name('produk.s_kategori');
Route::post('/master/produk/u_kategori', 'MasterController@post_kategori')->name('produk.u_kategori');

Route::post('/master/produk/s_produk', 'MasterController@post_produk')->name('produk.s_produk');

/*MODAL FORM*/
