<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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
        return view('transaksi.verifikasi_retur');
    }

    public function cart_index()
    {
        $data['data'] =  DB::table('keranjang_belanja')->select('kode_produk',  DB::raw('sum(jumlah) total'), 'kode_ukuran', 'kode_warna')
            ->where('kode_pelanggan', Auth::user()->id)
            ->groupBy('kode_produk', 'jumlah', 'kode_ukuran', 'kode_warna')
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
}
