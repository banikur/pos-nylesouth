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
 
Route::get('/', 'VerifiedController@index')->name('/');
Route::get('/detail-produk', 'VerifiedController@detail_index')->name('detail');
// Route::get('/testapi', 'VerifiedController@testapi')->name('testapi');
// Route::get('/testapi2/{id}', 'VerifiedController@testapi2')->name('testapi2');
Route::get('/get_service_shipping', 'VerifiedController@get_service_shipping')->name('get_service_shipping');
Route::get('/master_kab_kota/{kode}', 'VerifiedController@master_kab_kota');
Route::get('/get_disc/{kode}', 'VerifiedController@get_disc');


Route::get('logout', [
    'as' => 'account-sign-out',
    'uses' => 'Auth\LoginController@logout'
]);

Route::post('/storeMedia', 'VerifiedController@storeMedia')->name('projects.storeMedia');
Route::post('/dropzoneRemove', 'VerifiedController@dropzoneRemove')->name('projects.dropzoneRemove');

Route::post('/add-to-chart', 'VerifiedController@post_keranjang')->name('user.add_keranjang');


Auth::routes();

/*PAGE INIT*/
Route::get('/home', 'HomeController@index')->name('home');

// PROFIL
Route::get('/profil', 'HomeController@profil')->name('profil');
Route::post('/profil/update', 'HomeController@post_profil')->name('post_profil');

/*TRANSAKSI*/
Route::namespace('Master')->group(function () {
    Route::prefix('master')->name('master.')->group(function () {
        Route::get('/provinsi', 'MasterController@provinsi_index')->name('provinsi');
        Route::get('/pelanggan', 'MasterController@pelanggan_index')->name('pelanggan');
        Route::get('/produk', 'MasterController@produk_index')->name('produk');
        Route::get('/promo', 'MasterController@promo_index')->name('promo');
        Route::get('/promo/hapus/{id}', 'MasterController@promo_hapus')->name('promo_hapus');
    });
    /*START MODAL FORM*/
    Route::prefix('master')->name('master.form.modal.')->group(function () {
        Route::get('/master/ukuran/form', 'MasterController@form_ukuran')->name('ukuran');
        Route::get('/master/warna/form', 'MasterController@form_warna')->name('warna');
        Route::get('/master/kategori/form', 'MasterController@form_kategori')->name('kategori');
        Route::get('/master/produk/form', 'MasterController@form_produk')->name('produk');

        Route::get('/master/produk/detail', 'MasterController@detail_produk')->name('detail_produk');
        Route::get('/master/produk/edit', 'MasterController@edit_produk')->name('edit_produk');
    });
    Route::prefix('master')->name('master.form.modal.action.')->group(function () {
    Route::post('/master/produk/s_warna', 'MasterController@post_warna')->name('s_warna');
        Route::post('/master/produk/u_warna', 'MasterController@post_warna')->name('u_warna');
        Route::post('/master/produk/s_ukuran', 'MasterController@post_ukuran')->name('s_ukuran');
        Route::post('/master/produk/u_ukuran', 'MasterController@post_ukuran')->name('u_ukuran');
        Route::post('/master/produk/s_kategori', 'MasterController@post_kategori')->name('u_kategori');
        Route::post('/master/produk/s_produk', 'MasterController@post_produk')->name('s_produk');
        Route::post('/master/produk/e_produk', 'MasterController@post_e_produk')->name('e_produk');
        Route::post('/master/promo/s_promo', 'MasterController@post_promo')->name('s_promo');
        Route::post('/master/promo/e_promo', 'MasterController@edit_promo')->name('e_promo');
    });
    /*END MODAL FORM*/
});
Route::namespace('Dashboard')->group(function () {
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
    Route::get('/grafik-produk-terjual', 'DashboardController@GrafikProdukTerjual')->name('GrafikProdukTerjual');
    Route::get('/grafik-stok-terjual', 'DashboardController@GrafikStokProduk')->name('GrafikProdukTerjual');
    Route::get('/grafik-laporan-pemasaran', 'DashboardController@GrafikLaporanPemasaran')->name('GrafikLaporanPemasaran');
});
Route::namespace('Transaksi')->group(function () {
    Route::prefix('verifikasi')->name('init.')->group(function () {
        Route::get('/daftar-pesanan', 'TransaksiController@pemesanan_index')->name('pemesanan');
        Route::get('/daftar-pesanan/get-pembayaran', 'TransaksiController@get_pembayaran')->name('get_pembayaran');
        Route::post('/daftar-pesanan/verifikasi', 'TransaksiController@verifikasi_pemesanan')->name('verifikasi_pemesanan');
        Route::get('/retur-barang', 'TransaksiController@retur_index')->name('retur');
        Route::post('/retur-barang/verifikasi', 'TransaksiController@verifikasi_return')->name('verifikasi_return');
        
        Route::get('/daftar-pengiriman', 'TransaksiController@pengiriman_index')->name('pengiriman');
        Route::post('/daftar-pengiriman/verifikasi', 'TransaksiController@verifikasi_pengiriman')->name('verifikasi_pengiriman');
    });
});
/*TRANSAKSI*/

/*PAGE INIT*/

/*USER*/
Route::get('/cart', 'Transaksi\TransaksiController@cart_index')->name('cart');
Route::name('transaksi.')->group(function () {
    Route::get('modal_cart', 'Transaksi\TransaksiController@modal_edit_cart')->name('modal_edit_cart');
    Route::post('update_modal_cart', 'Transaksi\TransaksiController@update_modal_cart')->name('update_modal_cart');
    Route::get('modal_cart/hapus/{id_cart}', 'Transaksi\TransaksiController@modal_hapus_cart')->name('modal_hapus_cart');
    Route::post('modal_cart/checkout', 'Transaksi\TransaksiController@modal_checkout_cart')->name('modal_checkout_cart');
    Route::get('modal_cart/return', 'Transaksi\TransaksiController@modal_return_cart')->name('modal_return_cart');
    Route::get('modal_cart/return/get-produk', 'Transaksi\TransaksiController@get_produk_in_keranjang')->name('get_produk_in_keranjang');
    Route::get('modal_cart/return/get-produk-jumlah', 'Transaksi\TransaksiController@get_produk_jumlah_in_keranjang')->name('get_produk_jumlah_in_keranjang');
    Route::post('update_modal_return', 'Transaksi\TransaksiController@update_modal_return')->name('update_modal_return');
    Route::get('update_barang_checkout/{param}', 'Transaksi\TransaksiController@update_barang_checkout')->name('update_barang_checkout');
});
