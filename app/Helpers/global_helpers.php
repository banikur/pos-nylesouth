<?php

use Illuminate\Support\Facades\DB;


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

if(!function_exists('tgl_indo')){
	function tgl_indo($tanggal)
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
		$pecahkan = explode('-', $tanggal);

		return $pecahkan[2] . ' ' . $bulan[(int) $pecahkan[1]] . ' ' . $pecahkan[0];
	}
}

if (!function_exists('get_master_promo')) {
	function get_master_promo()
	{
		return DB::table('master_promo')
			->get();
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

if (!function_exists('get_master_prov')) {
	function get_master_prov()
	{
		return DB::table('master_provinsi')
			->whereNotNull('id_api')
			->get();
	}
}

if (!function_exists('get_master_kab_kota')) {
	function get_master_kab_kota($id)
	{
		return DB::table('master_kab_kota')
			->where('id_provinsi_api', $id)
			->whereNotNull('id_api')
			->get();
	}
}

if (!function_exists('get_master_pelanggan')) {
	function get_master_pelanggan()
	{
		return DB::table('users')
			->whereNull('tipe_user')
			->get();
	}
}

if (!function_exists('get_master_produk')) {
	function get_master_produk()
	{
		return DB::table('master_produk')
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

if (!function_exists('get_data_return')) {
	function get_data_return()
	{
		return DB::table('data_retur')
		->join('users','users.id','data_retur.kode_pelanggan')	
		->get();
	}
}

if (!function_exists('get_master_pesanan')) {
	function get_master_pesanan()
	{
		return DB::table('data_pemesanan')->select('users.alamat','kode_trx_pemesanan','kode_pelanggan','name','total_harga','status_pemesanan','biaya_kirim','kurir')
		->join('users','users.id','data_pemesanan.kode_pelanggan')
		->groupBy('users.alamat','kode_trx_pemesanan','kode_pelanggan','name','total_harga','status_pemesanan','biaya_kirim','kurir')
		->get();
	}
}

if (!function_exists('get_master_pesanan_detail')) {
	function get_master_pesanan_detail($kode_trx_pemesanan, $kode_pelanggan)
	{
		return DB::table('data_pemesanan')
		->where('kode_trx_pemesanan', $kode_trx_pemesanan)
		->where('kode_pelanggan', $kode_pelanggan)
		->get();
	}
}

if (!function_exists('get_master_pengiriman')) {
	function get_master_pengiriman()
	{
		return DB::table('data_pengiriman')->get();
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
		$data = DB::table('master_kode_warna')->where('kode_warna', $id)->first();
		$retVal = (!empty($data)) ? $data->nama_warna : 'Tidak Ditemukan';
		return $retVal;
	}
}

if (!function_exists('get_stok')) {
	function get_stok($id)
	{
		$data = DB::table('master_produk_inventori')->where('initial_produk', $id)->first();
		$retVal = (!empty($data)) ? $data->in - $data->out : 'Tidak Ditemukan';
		return $retVal;
	}
}

if (!function_exists('get_picture_id')) {
	function get_picture_id($id)
	{
		$data = DB::table('master_produk_picture')->where('initial_produk', $id)->first();
		$retVal = (!empty($data)) ? $data : 'Tidak Ditemukan';
		return $retVal;
	}
}

if (!function_exists('get_picture_array')) {
	function get_picture_array($id)
	{
		$data = DB::table('master_produk_picture')->where('initial_produk', base64_decode($id))->get();
		$retVal = (!empty($data)) ? $data : 'Tidak Ditemukan';
		return $retVal;
	}
}

if (!function_exists('get_desc_id')) {
	function get_desc_id($id)
	{
		$data = DB::table('master_produk_detail')->where('initial_produk', $id)->first();
		$retVal = (!empty($data)) ? $data->deskripsi_produk : 'Tidak Ditemukan';
		return $retVal;
	}
}

if (!function_exists('get_detail_warna_id')) {
	function get_detail_warna_id($id)
	{
		return DB::table('master_produk_detail')
			->select('warna')
			->where('initial_produk', base64_decode($id))
			->groupBy('warna')
			->get();
	}
}

if (!function_exists('get_detail_ukuran_id')) {
	function get_detail_ukuran_id($id)
	{
		return DB::table('master_produk_detail')
			->select('ukuran')
			->where('initial_produk', base64_decode($id))
			->groupBy('ukuran')
			->get();
	}
}

if (!function_exists('get_master_detail_produk_id')) {
	function get_master_detail_produk_id($kode_produk, $kode_ukuran, $kode_warna)
	{
		$detail_produk = DB::table('master_produk_detail')
			->where('initial_produk', $kode_produk)
			->where('ukuran', $kode_ukuran)
			->where('warna', $kode_warna)
			->first();

		return !empty($detail_produk) ? $detail_produk->id_detail_produk : '';
	}
}

if (!function_exists('get_master_produk_id')) {
	function get_master_produk_id($id)
	{
		return DB::table('master_produk')
			->where('initial_produk', base64_decode($id))
			->first();
	}
}

if (!function_exists('get_warna_id')) {
	function get_warna_id($id)
	{
		return DB::table('master_kode_warna')
			->where('kode_warna', $id)
			->first();
	}
}

if (!function_exists('get_disc_id')) {
	function get_disc_id($id)
	{
		$datenow = date('Y-m-d');
		$data = DB::table('master_promo')
			->where('kode_promo', $id)
			// ->where('tgl_mulai', '<', $datenow)
			->where('tgl_berakhir', '>', $datenow)
			->get();
		
		if (count($data) > 0) {
			return $data[0]->potongan_harga;
		} else {
			return 0;
		}
	}
}

if (!function_exists('get_initial_cart')) {
	function get_initial_cart($id)
	{
		$data = DB::table('keranjang_belanja')->where('kode_keranjang', $id)->first();
		$retVal = (!empty($data)) ? $data->kode_produk : '-';
		return $retVal;
	}
}

if (!function_exists('get_detail_produk_id')) {
	function get_detail_produk_id($id, $kepentingan)
	{
		$detail = DB::table('master_produk_detail')->where('id_detail_produk', $id)->first();
		if($kepentingan == 'warna'){
			$data = DB::table('master_kode_warna')->where('kode_warna',$detail->warna)->first();
		}else{
			$data = $detail;
		}

		return ($data) ? $data : '-';

	}
}

/*END BANI*/
