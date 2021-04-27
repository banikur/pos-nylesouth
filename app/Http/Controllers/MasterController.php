<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MasterController extends Controller
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
    public function provinsi_index()
    {
        return view('master.provinsi');
    }
    public function pelanggan_index()
    {
        return view('master.pelanggan');
    }
    public function produk_index()
    {
        return view('master.produk');
    }

    /*FORM MODAL*/
    public function form_ukuran()
    {
        return view('master.modal.form_ukuran');
    }
    public function form_warna()
    {
        return view('master.modal.form_warna');
    }
    public function form_kategori()
    {
        return view('master.modal.form_kategori');
    }
    public function form_produk()
    {
        return view('master.modal.form_produk');
    }
    /*FORM MODAL*/

    /*CRUD*/
    public function post_ukuran(Request $request)
    {
       dd($request->all());
       
    }
    /*CRUD*/

    /*DATATABLE*/
    public function data_ukuran()
    {
        return view('master.modal.form_ukuran');
    }
    /*DATATABLE*/
    
    /*Auto Generate*/

    public function generate_warna($rest)
    {
        $iduser = Auth::user()->id;
        $tanggalskr = date('Y-m-d H:i:s');
        $date = date_format(date_create($tanggalskr), 'Y/m/d');
        $code = 'WRN';
        $no = 0;
        if ($rest == 0) {
            $no = "$code-0001";
            $autonya = $no;
        } else if ($rest < 9) {
            $no = $rest + 1;

            $autonya = "$code-000$no";
        } else if ($rest < 99) {
            $no = $rest + 1;

            $autonya = "$code-00$no";
        } else if ($rest < 999) {
            $no = $rest + 1;

            $autonya = "$code-0$no";
        } else if ($rest < 9999) {
            $no = $rest + 1;

            $autonya = "$code-$no";
        } else {
            $autonya = "$code-0001";
        }
        return $autonya;
    }
    public function generate_ukuran($rest)
    {
        $tanggalskr = date('Y-m-d H:i:s');
        $code = 'SZ';
        $no = 0;
        if ($rest == 0) {
            $no = "$code-0001";
            $autonya = $no;
        } else if ($rest < 9) {
            $no = $rest + 1;

            $autonya = "$code-000$no";
        } else if ($rest < 99) {
            $no = $rest + 1;

            $autonya = "$code-00$no";
        } else if ($rest < 999) {
            $no = $rest + 1;

            $autonya = "$code-0$no";
        } else if ($rest < 9999) {
            $no = $rest + 1;

            $autonya = "$code-$no";
        } else {
            $autonya = "$code-0001";
        }
        return $autonya;
    }
    public function generate_produk($rest,$jenis,$warna)
    {
        $tanggalskr = date('Y-m-d H:i:s');
        $code = $jenis;
        $no = 0;
        if ($rest == 0) {
            $no = "$code/$warna-0001";
            $autonya = $no;
        } else if ($rest < 9) {
            $no = $rest + 1;

            $autonya = "$code/$warna-000$no";
        } else if ($rest < 99) {
            $no = $rest + 1;

            $autonya = "$code/$warna-00$no";
        } else if ($rest < 999) {
            $no = $rest + 1;

            $autonya = "$code/$warna-0$no";
        } else if ($rest < 9999) {
            $no = $rest + 1;

            $autonya = "$code/$warna-$no";
        } else {
            $autonya = "$code/$warna-0001";
        }
        return $autonya;
    }
    public function generate_pemesananan($rest)
    {
        $tanggalskr = date('Y-m-d H:i:s');
        $code = 'TRX';
        $no = 0;
        $rndm= rand(10,1000);
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
