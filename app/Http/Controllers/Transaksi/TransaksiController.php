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

    public function cart_index()
    {
        $data['data'] =  DB::table('keranjang_belanja')->select('kode_produk',  DB::raw('sum(jumlah) as cart'), 'kode_ukuran', 'kode_warna', DB::raw('sum(berat_barang) total_berat'), 'kode_keranjang')
            ->where('kode_pelanggan', Auth::user()->id)
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
}
