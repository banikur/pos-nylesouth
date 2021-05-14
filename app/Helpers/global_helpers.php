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
			// ->LeftJoin('master_produk_detail', 'master_produk_detail.initial_produk', 'master_produk.initial_produk')
			// ->LeftJoin('master_produk_picture', 'master_produk_picture.initial_produk', 'master_produk.initial_produk')
			->Join('master_kategori', 'master_kategori.kode_kategori', 'master_produk.kode_kategori')
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

if (!function_exists('get_master_pesanan')) {
	function get_master_pesanan()
	{
		return DB::table('data_pemesanan')
			->Join('users_pelanggan_detail', 'users_pelanggan_detail.kode_pelanggan', 'data_pemesanan.kode_pelanggan')
			->get();
	}
}

if (!function_exists('get_master_kategori_id')) {
	function get_master_kategori_id($id)
	{
		$data = DB::table('master_kategori')->where('kode_kategori', $id)->first();
		$retVal = (!empty($data)) ? $data->nama_kategori : 'Tidak Ditemukan';
		return $retVal;
	}
}

if (!function_exists('master_kode_warna_id')) {
	function master_kode_warna_id($id)
	{
		$data = DB::table('master_kode_warna')->where('nama_warna', $id)->first();
		$retVal = (!empty($data)) ? $data->nama_kategori : 'Tidak Ditemukan';
		return $retVal;
	}
}

if (!function_exists('get_stok')) {
	function get_stok($id)
	{
		$data = DB::table('master_produk_inventori')->where('initial_produk', $id)->first();
		$retVal = (!empty($data)) ? $data->stock : 'Tidak Ditemukan';
		return $retVal;
	}
}

/*END BANI*/
