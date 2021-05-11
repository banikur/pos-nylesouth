<?php

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Models\usermanajemen\Menu;
use  App\Models\usermanajemen\GrupAkses;
use  App\Models\usermanajemen\HakAkses;
use App\Models\usermanajemen\PengaturanAkses;
use App\Models\Notifications;


/*START BANI*/

if (!function_exists('bulan_indo')) {
	function bulan_indo($index)
	{
		$bulan = array(
			1 =>   'Januari',
			'Februari',
			'Maret',
			'April',
			'Mei',
			'Juni',
			'Juli',
			'Agustus',
			'September',
			'Oktober',
			'November',
			'Desember'
		);


		return $bulan[(int) $index];
	}
}

if (!function_exists('get_master_kabkota_prov')) {
	function get_master_kabkota_prov()
	{
		return DB::table('master_kab_kota')
			->leftjoin('master_provinsi', 'master_provinsi.id', 'master_kab_kota.id_provinsi')
			->get();
	}
}

if (!function_exists('get_master_pelanggan')) {
	function get_master_pelanggan()
	{
		return DB::table('users')
			->LeftJoin('users_pelanggan_detail', 'users_pelanggan_detail.kode_pelanggan', 'users.id')
			->whereNull('users.tipe_user')
			->get();
	}
}

if (!function_exists('get_master_produk')) {
	function get_master_produk()
	{
		return DB::table('master_produk')
			->LeftJoin('master_produk_detail', 'master_produk_detail.initial_produk', 'master_produk.initial_produk')
			->LeftJoin('master_produk_kode_warna', 'master_produk_kode_warna.id_produk', 'master_produk.kode_produk')
			->LeftJoin('master_produk_picture', 'master_produk_picture.id_produk', 'master_produk.kode_produk')
			->LeftJoin('master_kategori', 'master_kategori.kode_kategori', 'master_produk.kode_kategori')
			->get();
	}
}

if (!function_exists('get_master_kategori')) {
	function get_master_kategori()
	{
		return DB::table('master_kategori')
			->get();
	}
}

if (!function_exists('get_master_ukuran')) {
	function get_master_ukuran()
	{
		return DB::table('master_ukuran')
			->get();
	}
}

if (!function_exists('get_master_warna')) {
	function get_master_warna()
	{
		return DB::table('master_kode_warna')
			->get();
	}
}

if (!function_exists('get_master_provinsi')) {
	function get_master_provinsi()
	{
		return DB::table('master_provinsi')
			->get();
	}
}

/*END BANI*/
