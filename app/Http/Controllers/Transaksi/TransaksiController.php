<?php

namespace App\Http\Controllers\Transaksi;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class TransaksiController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function pemesanan_index()
    {
        return view('master.transaksi.index');
    }

    public function verifikasi_index()
    {
        return view('transaksi.verifikasi_pembayaran');
    }

    public function retur_index()
    {
        return view('master.transaksi.verifikasi-retur');
    }

    public function pengiriman_index()
    {
        return view('master.transaksi.index_pengiriman');
    }

    function get_pembayaran(){
        $kode_trx_pemesanan = $_GET['kode_trx_pemesanan'];
        $kode_pelanggan = $_GET['kode_pelanggan'];
        $data['pembayaran'] = DB::table('data_pembayaran')
                    ->where('kode_trx_pemesanan', $kode_trx_pemesanan)
                    ->where('kode_pelanggan', $kode_pelanggan)
                    ->get();

        $data['pengiriman'] = DB::table('data_pembayaran')
                            ->join('data_pengiriman','data_pengiriman.kode_trx_pemesanan','data_pembayaran.kode_trx_pemesanan')
                            ->where('data_pengiriman.kode_trx_pemesanan',$kode_trx_pemesanan)
                            ->where('data_pembayaran.kode_pelanggan',$kode_pelanggan)->get();
                            
        $data['nama'] = DB::table('users')->where('id', $kode_pelanggan)->get();

        return $data;
    }

    function verifikasi_pemesanan(Request $request){

        date_default_timezone_set("Asia/Bangkok");

        // update status data_pemesanan
        $verifikasiPemesanan = DB::table('data_pemesanan')
                            ->where('kode_trx_pemesanan', $request->kode_trx_pemesanan)
                            ->where('kode_pelanggan', $request->kode_pelanggan)
                            ->update(['status_pemesanan'=>$request->status]);

        if($request->status == 3 || $request->status == 4){   
            //Insert ke data_pengiriman   
            $data['kode_trx_pemesanan']    = $request->kode_trx_pemesanan;
            $data['kurir']                 = $request->kurir;
            $data['nomor_resi']            = $request->no_resi;
            $data['biaya_kirim']           = $request->biaya_kirim;
            $data['nama_penerima']         = $request->nama_penerima;
            $data['no_hp_penerima']        = $request->no_penerima;
            $data['alamat_kirim']          = $request->alamat_penerima;
            $data['status_pengiriman']     = ($request->status == 3) ? 0 : 1;
            if($request->status == 4){
                $data['tanggal_kirim'] = date('Y-m-d H:i:s');
            }
            $pengiriman = DB::table('data_pengiriman')->where('kode_trx_pemesanan', $request->kode_trx_pemesanan)->get();
            $count_pengiriman = !empty($pengiriman) ? count($pengiriman) : 0;
            if($count_pengiriman > 0){
                DB::table('data_pengiriman')->where('kode_trx_pemesanan', $request->kode_trx_pemesanan)->update($data);
            }else{
                DB::table('data_pengiriman')->insert($data);
            }

        }
        
        // update stock out di master_produk_inventori
        if($request->status == 4){
            $countJumlah = count($request->jumlah);
            for($i = 0; $i<$countJumlah;$i++)
            {
                $stock_out = DB::table('master_produk_inventori')->where('initial_produk', $request->id_detail_produk[$i])->first();

                if(!empty($stock_out)){
                    $tambah_out = (int)$request->jumlah[$i] + $stock_out->out;
                }else{
                    $tambah_out = (int)$request->jumlah[$i];
                }
                
                $update = DB::table('master_produk_inventori')->where('initial_produk', $request->id_detail_produk[$i])
                ->update(['out'=>$tambah_out]);
            }
        }

        return redirect()->back()->with(['success'=>'Data Update']);
    }

    public function verifikasi_pengiriman(Request $request)
    {
        $update = DB::table('data_pengiriman')
                ->where('kode_trx_pemesanan', $request->kode_trx_pemesanan)
                ->update(['status_pengiriman' => $request->status]);

        return redirect()->back()->with(['success'=>'Data Update']);
    }

    public function cart_index()
    {
        $data['data'] =  DB::table('keranjang_belanja')->select('kode_produk',  DB::raw('sum(jumlah) as cart'), 'kode_ukuran', 'kode_warna', DB::raw('sum(berat_barang) total_berat'), 'kode_keranjang')
            ->where('kode_pelanggan', Auth::user()->id)
            ->whereNull('status')
            ->groupBy('kode_produk', 'jumlah', 'kode_ukuran', 'kode_warna', 'kode_keranjang')
            ->get();
        // dd($data);
        return view('user.cart', $data);
    }

    public function generate_pemesananan($rest)
    {
        date_default_timezone_set("Asia/Bangkok");

        $tanggalskr = date('Y-m-d H:i:s');
        $code = 'TRX';
        $no = 0;
        $rndm = rand(10, 1000);
        if ($rest == 0) {
            $no = "$tanggalskr/$code-0001-$rndm";
            $autonya = $no;
        } else if ($rest < 9) {
            $no = $rest + 1;

            $autonya = "$tanggalskr/$code-000$no-$rndm";
        } else if ($rest < 99) {
            $no = $rest + 1;

            $autonya = "$tanggalskr/$code-00$no-$rndm";
        } else if ($rest < 999) {
            $no = $rest + 1;

            $autonya = "$tanggalskr/$code-0$no-$rndm";
        } else if ($rest < 9999) {
            $no = $rest + 1;

            $autonya = "$tanggalskr/$code-$no-$rndm";
        } else {
            $autonya = "$tanggalskr/$code-0001-$rndm";
        }
        return $autonya;
    }

    public function modal_edit_cart(Request $request)
    {
        $data['initial_product'] = base64_encode(get_initial_cart($request->id_cart));
        $data['id_cart'] = $request->id_cart;
        $data['jumlah'] = $request->jumlah;
        $data['ukuran'] = $request->ukuran;
        $data['warna'] = $request->warna;
        // dd($data);
        return view('user.modal_ubah', $data);
    }

    public function update_modal_cart(Request $request)
    {
        date_default_timezone_set("Asia/Bangkok");

        try {
            DB::table('keranjang_belanja')
                ->where('kode_keranjang', $request->id_cart)
                ->where('kode_pelanggan', Auth::user()->id)
                ->update([
                    'kode_ukuran' => $request->kode_ukuran,
                    'kode_pelanggan' => Auth::user()->id,
                    'kode_warna' => $request->kode_warna,
                    'jumlah' => $request->jumlah,
                    'created_at' => date('Y-m-d H:i:s'),
                ]);
            return redirect()->back()->with('message', 'success');
        } catch (MySQLException  $ms) {
            return redirect()->back()->with('message', 'error ' . $ms);
        }
    }

    public function modal_hapus_cart(Request $request){
        $delete_cart = DB::table('keranjang_belanja')->where('kode_keranjang', $request->id_cart)->delete();

        if($delete_cart){
            return redirect()->back()->with(['success'=>'Data Hapus']);
        }else{
            return redirect()->back()->with(['error'=>'Data Hapus']);
        }
    }

    public function modal_checkout_cart(Request $request){
        date_default_timezone_set("Asia/Bangkok");
        $datenow = date('Y-m-d H:i:s');

        $get_last = DB::table('data_pemesanan')->select('kode_trx_pemesanan')->orderBy('created_at', 'DESC')->first();
        $last = ($get_last) ? substr($get_last->kode_trx_pemesanan, -8, 4) : 0;
        $kode_trx_pemesanan = $this->generate_pemesananan($last);
        
        $countData = count($request->kode_produk);
        for ($i = 0; $i < $countData; $i++) {
            DB::table('data_pemesanan')->insert([
                'kode_trx_pemesanan' => $kode_trx_pemesanan,
                'kode_pelanggan' => Auth::user()->id,
                'kode_produk'    => $request->kode_produk[$i],
                'tanggal_pesan'  => $datenow,
                'jumlah'         => $request->jumlah[$i],
                'kurir'          => $request->jasa_kurir,
                'sub_total'      => $request->sub_total[$i],
                'biaya_kirim'      => $request->biaya_kirim,
                'total_harga'    => $request->total_harga,
                'status_pemesanan' => 0,
                'id_detail_produk' => $request->id_detail_product[$i],
                'created_at'     => $datenow
            ]);
            DB::table('keranjang_belanja')->where('kode_keranjang', $request->id_keranjang[$i])->update(['status'=>1]);
        }
        
        // $filename = $request->bukti_tf->getOriginalName();
        $file = $request->file('bukti_tf');
        $filename = $file->getClientOriginalName();
        $detination = 'uploads/bukti_transfer/';
        $path = '/uploads/bukti_transfer/'.$filename;
        $file->move($detination,$filename);
        $pembayanan = [
            'kode_trx_pemesanan'    => $kode_trx_pemesanan,
            'kode_pelanggan'        => Auth::user()->id,
            'transfer_atas_nama'    => $request->tf_an,
            'notes'                 => $request->catatan,
            'status_bayar'          => 0,
            'pembayaran_foto_folder_path' => $path,
            'created_at'            => $datenow,
        ];
        DB::table('data_pembayaran')->insert($pembayanan);

        return redirect()->back()->with(['success'=>'Data Simpan']);
    }

    public function modal_return_cart(Request $request){
        $data['kode_pelanggan'] = $request->kode_pelanggan;
        $data['pemesanan'] = DB::table('data_pemesanan')->select('kode_produk')
                        ->where('kode_pelanggan', $data['kode_pelanggan'])
                        ->where('status_pemesanan', 4)
                        ->whereNull('status_retur')
                        ->groupBy('kode_produk')
                        ->whereNull('deleted_at')
                        ->get();

        return view('user.modal_return', $data);
    }

    public function get_produk_in_keranjang(Request $request){
        $data['kode_pelanggan'] = $request->kode_pelanggan;
        $data['kode_produk'] = $request->kode_produk;

        $data['initial_product'] = base64_encode($data['kode_produk']);

        $data['keranjang'] = DB::table('keranjang_belanja')
                    ->where('kode_pelanggan', $data['kode_pelanggan'])
                    ->where('kode_produk', $data['kode_produk'])
                    ->where('status', 1)
                    ->whereNull('deleted_at')
                    ->get();
        
        return view('user.modal_return_view', $data);
    }

    public function get_produk_jumlah_in_keranjang(Request $request){
        $kode_pelanggan = $request->kode_pelanggan;
        $kode_produk = $request->kode_produk;
        $kode_warna = $request->kode_warna;
        $kode_ukuran = $request->kode_ukuran;

        $keranjang = DB::table('keranjang_belanja')
                    ->where('kode_pelanggan', $kode_pelanggan)
                    ->where('kode_produk', $kode_produk)
                    ->where('kode_warna', $kode_warna)
                    ->where('kode_ukuran', $kode_ukuran)
                    ->where('status', 1)
                    ->first();

        echo json_encode($keranjang);
    }

    public function update_modal_return(Request $request){

        date_default_timezone_set("Asia/Bangkok");
        
        $detail_produk = DB::table('master_produk_detail')
                        ->where('initial_produk', $request->produkReturn)
                        ->where('ukuran', $request->kode_ukuran)
                        ->where('warna', $request->kode_warna)
                        ->first();

        //update pemesanan dan keranjang untuk return ulang
        $update_pemesanan = DB::table('data_pemesanan')
                ->where('id_detail_produk', $detail_produk->id_detail_produk)
                ->update(['deleted_at'=>date('Y-m-d H:i:s')]);
        $update_keranjang = DB::table('keranjang_belanja')
                ->where('kode_produk', $request->produkReturn)
                ->where('kode_ukuran', $request->kode_ukuran)
                ->where('kode_pelanggan', $request->kode_pelanggan)
                ->where('kode_warna', $request->kode_warna)
                ->update(['deleted_at'=>date('Y-m-d H:i:s')]);

        $cekReturnBarang = DB::table('data_retur')
                        ->where('kode_pelanggan', $request->kode_pelanggan)
                        ->where('kode_produk', $request->produkReturn)
                        ->where('kode_warna', $request->kode_warna)
                        ->where('kode_ukuran', $request->kode_ukuran)
                        ->where('jumlah', $request->jumlah)
                        ->where('status_retur', 2);
        if($cekReturnBarang->count() > 0){
            $data = [
                'kode_pelanggan'    => $request->kode_pelanggan,
                'kode_produk'       => $request->produkReturn,
                'kode_warna'        => $request->kode_warna,
                'kode_ukuran'       => $request->kode_ukuran,
                'alasan_retur'      => $request->alasan,
                'jumlah'            => $request->jumlah,
                'status_retur'      => 0,
            ];
            $cekReturnBarang->update($data);
        }else{
            $data = [
                'kode_pelanggan'    => $request->kode_pelanggan,
                'kode_produk'       => $request->produkReturn,
                'kode_warna'        => $request->kode_warna,
                'kode_ukuran'       => $request->kode_ukuran,
                'alasan_retur'      => $request->alasan,
                'jumlah'            => $request->jumlah,
                'status_retur'      => 0,
            ];
            DB::table('data_retur')->insert($data);
        }

        return redirect()->back()->with('message', 'success');
    }

    public function verifikasi_return(Request $request){

        date_default_timezone_set("Asia/Bangkok");

        $detail_produk = DB::table('master_produk_detail')
                        ->where('initial_produk', $request->kode_produk)
                        ->where('ukuran', $request->kode_ukuran)
                        ->where('warna', $request->kode_warna)
                        ->first();
                        
        // update stok
        if($request->status == 1){
            $stok = DB::table('master_produk_inventori')->where('initial_produk', $detail_produk->id_detail_produk)->first();
            $kurang_out = (int)$stok->out - (int)$request->jumlah;
            $update_stok = DB::table('master_produk_inventori')
                        ->where('initial_produk', $detail_produk->id_detail_produk)
                        ->update(['out'=>$kurang_out]);
            $update_pemesanan = DB::table('data_pemesanan')
                    ->where('id_detail_produk', $detail_produk->id_detail_produk)
                    ->update(['status_retur'=>1]);
            $update_return = DB::table('data_retur')->where('kode_retur', $request->kode_retur)->update(['tanggal_retur'=>date('Y-m-d H:i:s')]);
        }elseif($request->status == 2){
            $update_pemesanan = DB::table('data_pemesanan')
                    ->where('id_detail_produk', $detail_produk->id_detail_produk)
                    ->update(['deleted_at'=>null]);
            $update_keranjang = DB::table('keranjang_belanja')
                    ->where('kode_produk', $request->kode_produk)
                    ->where('kode_ukuran', $request->kode_ukuran)
                    ->where('kode_pelanggan', $request->kode_pelanggan)
                    ->where('kode_warna', $request->kode_warna)
                    ->update(['deleted_at'=>null]);
        }

        // update status retur
        $update_return = DB::table('data_retur')->where('kode_retur', $request->kode_retur)->update(['status_retur'=>$request->status]);

        return redirect()->back()->with('message', 'success');
    }
}
