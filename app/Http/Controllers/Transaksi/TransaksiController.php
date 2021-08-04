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

        $verifikasiPemesanan = DB::table('data_pemesanan')
                            ->where('kode_trx_pemesanan', $request->kode_trx_pemesanan)
                            ->where('kode_pelanggan', $request->kode_pelanggan)
                            ->update(['status_pemesanan'=>$request->status]);

        if($request->status == 3 || $request->status == 4){        
            $data = [
                'kode_trx_pemesanan'    => $request->kode_trx_pemesanan,
                'kurir'                 => $request->kurir,
                'nomor_resi'            => $request->no_resi,
                'biaya_kirim'           => $request->biaya_kirim,
                'nama_penerima'         => $request->nama_penerima,
                'no_hp_penerima'        => $request->no_penerima,
                'alamat_kirim'          => $request->alamat_penerima,
                'status_pengiriman'     => ($request->status == 3) ? 0 : 1,
            ];
            $pengiriman = DB::table('data_pengiriman')->where('kode_trx_pemesanan', $request->kode_trx_pemesanan)->get();
            $count_pengiriman = !empty($pengiriman) ? count($pengiriman) : 0;
            if($count_pengiriman > 0){
                DB::table('data_pengiriman')->where('kode_trx_pemesanan', $request->kode_trx_pemesanan)->update($data);
            }else{
                DB::table('data_pengiriman')->insert($data);
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
}
