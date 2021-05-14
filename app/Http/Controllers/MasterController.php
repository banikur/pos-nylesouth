<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function detail_produk(Request $request)
    {
        $initial_code = $request->id;
        $data['detail'] = DB::table('master_produk_detail')->where('initial_produk', base64_decode($initial_code))->get();
        $data['invetori'] = DB::table('master_produk_inventori')->where('initial_produk', base64_decode($initial_code))->get();
        $data['picture'] = DB::table('master_produk_picture')->where('initial_produk', base64_decode($initial_code))->get();

        return view('master.modal.view_produk', $data);
    }
    /*FORM MODAL*/

    /*CRUD*/
    public function post_warna(Request $request)
    {
        try {
            if ($request->id_warna == null) {
                $validate =  DB::table('master_kode_warna')->where('nama_warna', trim($request->warna))->count();
                if ($validate > 0) {
                    return redirect()->back()->with('error', 'Duplikat Data');
                } else {
                    DB::table('master_kode_warna')->insert(
                        [
                            'nama_warna' => $request->warna,
                            'created_at' => date('Y-m-d H:i:s'),
                        ]
                    );
                }
            } else {
                DB::table('master_kode_warna')->where('kode_warna', $request->id_warna)->update(
                    [
                        'nama_warna' => $request->warna,
                        'updated_at' => date('Y-m-d H:i:s'),
                    ]
                );
            }
            return redirect()->back()->with('message', 'success');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', 'Gagal koneksi ke database');
        }
    }
    public function post_ukuran(Request $request)
    {
        try {
            if ($request->id_ukuran == null) {
                $validate =  DB::table('master_ukuran')->where('nama_ukuran', trim($request->ukuran))->count();
                if ($validate > 0) {
                    return redirect()->back()->with('error', 'Duplikat Data');
                } else {
                    DB::table('master_ukuran')->insert(
                        [
                            'nama_ukuran' => $request->ukuran,
                            'created_at' => date('Y-m-d H:i:s'),
                        ]
                    );
                }
            } else {
                DB::table('master_ukuran')->where('kode_ukuran', $request->id_ukuran)->update(
                    [
                        'nama_ukuran' => $request->ukuran,
                        'updated_at' => date('Y-m-d H:i:s'),
                    ]
                );
            }
            return redirect()->back()->with('message', 'success');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', 'Gagal koneksi ke database');
        }
    }
    public function post_kategori(Request $request)
    {
        try {
            if ($request->id_ukuran == null) {
                $validate =  DB::table('master_kategori')->where('nama_kategori', trim($request->kategori))->count();
                if ($validate > 0) {
                    return redirect()->back()->with('error', 'Duplikat Data');
                } else {
                    DB::table('master_kategori')->insert(
                        [
                            'nama_kategori' => $request->kategori,
                            'created_at' => date('Y-m-d H:i:s'),
                        ]
                    );
                }
            } else {
                DB::table('master_kategori')->where('kode_kategori', $request->id_kategori)->update(
                    [
                        'nama_kategori' => $request->kategori,
                        'updated_at' => date('Y-m-d H:i:s'),
                    ]
                );
            }
            return redirect()->back()->with('message', 'success');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', 'Gagal koneksi ke database');
        }
    }

    public function post_produk(Request $request)
    {
        // try {
        $jenis = $request->kategori_produk;
        $get_last = DB::table('master_produk')->select('initial_produk')->orderBy('created_at', 'DESC')->first();
        $last = ($get_last) ? (int) substr($get_last->initial_produk, -4, 4) : 0;
        // dd($request->all());
        $initial_produk = $this->generate_produk($last, $jenis);
        // dd( );
        DB::table('master_produk')->insert(
            [
                'initial_produk' => $initial_produk,
                'kode_kategori' => $request->kategori_produk,
                'nama_produk' => $request->nama_produk,
                'harga_produk' =>  str_replace(',', '.', str_replace('.', '', $request->harga_produk)),
                'created_by' => 1,
                'created_at' => date('Y-m-d H:i:s'),
            ]
        );
        for ($i = 0; $i < Count($request->warna); $i++) {
            for ($j = 0; $j < count($request->ukuran); $j++) {
                $id_detail = $this->generate_detail($initial_produk);
                DB::table('master_produk_detail')->insert(
                    [
                        'id_detail_produk' => $id_detail,
                        'initial_produk' => $initial_produk,
                        'deskripsi_produk' => $request->deskripsi_produk,
                        'berat_produk' => str_replace(',', '.', $request->berat_produk),
                        'ukuran' => $request->ukuran[$j],
                        'warna' => $request->warna[$i],
                    ]
                );
                DB::table('master_produk_inventori')->insert(
                    [
                        'initial_produk' => $id_detail,
                        'in' => $request->stok_awal_produk,
                        'stock' => $request->stok_awal_produk,
                        'created_at' => date('Y-m-d H:i:s'),
                    ]
                );
            }
        }
        if (!empty($request->image)) {
            $images = count($request->image);
        } else {
            $images = 0;
        }
        $url = '/uploads/temp/';
        for ($sk = 0; $sk < $images; $sk++) {
            DB::table('master_produk_picture')->insert(
                [
                    'initial_produk' => $initial_produk,
                    'path_file' => $url,
                    'nama_file' => $request->image[$sk],
                    'created_at' => date('Y-m-d H:i:s'),
                ]
            );
        }

        return redirect()->back()->with('message', 'success');
        // } catch (\Throwable $th) {
        //     //throw $th;
        //     return redirect()->back()->with('error', 'Gagal koneksi ke database');
        // }
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
    public function generate_produk($rest)
    {
        $tanggalskr = date('Y-m-d H:i:s');
        $code = "NS";
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
    public function generate_detail($initial_code)
    {
        $code = 'BN-' . $initial_code;
        $no = 0;
        $rndm = rand(10, 1000);
        $no = "$code-$rndm";
        $autonya = $no;
        return $autonya;
    }
}
