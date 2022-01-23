<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
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
    public function index()
    {
        return view('dashboard.index');
    }

    public function GrafikProdukTerjual()
    {
        $tahun = date('Y');

        $series = [];
        $seriesData = [];

        $ArrayBulan = ['01'=>'Jan', '02'=>'Feb', '03'=>'Mar', '04'=>'Apr', '05'=>'May', '06'=>'Jun', '07'=>'Jul', '08'=>'Aug', '09'=>'Sep', '10'=>'Oct', '11'=>'Nov', '12'=>'Dec'];
        foreach($ArrayBulan as $index=>$value){
            $category[] = $value;
            $categoryIndex[] = $index;
        }

        $barang_terjual = DB::table('data_pemesanan')->whereNull('status_retur')->select('kode_produk')->groupBy('kode_produk')->get();
        foreach($barang_terjual as $bt){
            $barang[] = $bt->kode_produk;
        }

        if(!empty($barang)){
            foreach($barang as $b){
                $seriesData['name'] = DB::table('master_produk')->where('initial_produk',$b)->first()->nama_produk;
                foreach($categoryIndex as $ci){
                    $seriesData['data'][] = (int)DB::table('data_pemesanan')
                                        ->whereMonth('tanggal_pesan',$ci)
                                        ->whereYear('tanggal_pesan', $tahun)
                                        ->where('kode_produk', $b)
                                        ->sum('jumlah');
                }
                
                $series[] = $seriesData;
                $seriesData = [];
            }
        }else{
            $seriesData['name'] = 'TIDAK ADA';
                foreach($categoryIndex as $ci){
                    $seriesData['data'][] = 0;
                }
            $series[] = $seriesData;
            $seriesData = [];
        }


        return json_encode([
            'series'    => $series,
            'bulan'     => $category,
            'tahun'     => $tahun,
        ]);
    }

    public function GrafikStokProduk()
    {
        $tahun = date('Y');

        $series = [];
        $seriesData = [];

        $ArrayBulan = ['01'=>'Jan', '02'=>'Feb', '03'=>'Mar', '04'=>'Apr', '05'=>'May', '06'=>'Jun', '07'=>'Jul', '08'=>'Aug', '09'=>'Sep', '10'=>'Oct', '11'=>'Nov', '12'=>'Dec'];
        foreach($ArrayBulan as $index=>$value){
            $category[] = $value;
            $categoryIndex[] = $index;
        }

        $stok_barang = DB::table('master_produk')->select('master_produk.nama_produk','master_kode_warna.nama_warna','master_produk_detail.ukuran','master_produk_detail.id_detail_produk','master_produk_detail.initial_produk')
                        ->join('master_produk_detail','master_produk_detail.initial_produk','master_produk.initial_produk')
                        ->join('master_kode_warna','master_kode_warna.kode_warna','master_produk_detail.warna')
                        ->limit(5)
                        ->orderBy('master_produk.created_at','DESC')
                        ->get();
        foreach($stok_barang as $bt){
            $barang[] = $bt;
        }

        if(!empty($barang)){
            foreach($barang as $b){
                $seriesData['name'] = $b->nama_produk.' ('.$b->nama_warna.') '.' ('.$b->ukuran.')';
                foreach($categoryIndex as $ci){
                    $seriesData['data'][] = (int)DB::table('master_produk')
                                        ->join('master_produk_detail','master_produk_detail.initial_produk','master_produk.initial_produk')
                                        ->join('master_produk_inventori','master_produk_inventori.initial_produk','master_produk_detail.id_detail_produk')
                                        ->whereMonth('master_produk.created_at',$ci)
                                        ->whereYear('master_produk.created_at', $tahun)
                                        ->where('master_produk_inventori.initial_produk', $b->id_detail_produk)
                                        ->sum('master_produk_inventori.stock');
                }
                
                $series[] = $seriesData;
                $seriesData = [];
            }
        }else{
            $seriesData['name'] = 'TIDAK ADA';
                foreach($categoryIndex as $ci){
                    $seriesData['data'][] = 0;
                }
            $series[] = $seriesData;
            $seriesData = [];
        }


        return json_encode([
            'series'    => $series,
            'bulan'     => $category,
            'tahun'     => $tahun,
        ]);
    }

    public function GrafikLaporanPemasaran()
    {
        $tahun = date('Y');

        $series = [];
        $seriesData = [];

        $stok_barang = DB::table('master_produk')->select('master_produk.nama_produk','master_kode_warna.nama_warna','master_produk_detail.ukuran','master_produk_detail.id_detail_produk','master_produk_detail.initial_produk')
                        ->join('master_produk_detail','master_produk_detail.initial_produk','master_produk.initial_produk')
                        ->join('master_kode_warna','master_kode_warna.kode_warna','master_produk_detail.warna')
                        ->join('master_produk_inventori','master_produk_inventori.initial_produk','master_produk_detail.id_detail_produk')
                        ->whereNotNull('master_produk_inventori.out')
                        ->limit(5)
                        ->get();
        foreach($stok_barang as $bt){
            $barang[] = $bt;
        }

        if(!empty($barang)){
            foreach($barang as $b){
                $seriesData['name'] = $b->nama_produk.' ('.$b->nama_warna.') '.' ('.$b->ukuran.')';
                $seriesData['y'] = (int)DB::table('master_produk')
                                    ->join('master_produk_detail','master_produk_detail.initial_produk','master_produk.initial_produk')
                                    ->join('master_produk_inventori','master_produk_inventori.initial_produk','master_produk_detail.id_detail_produk')
                                    ->whereYear('master_produk.created_at', $tahun)
                                    ->where('master_produk_inventori.initial_produk', $b->id_detail_produk)
                                    ->sum('master_produk_inventori.out');
                
                
                $series[] = $seriesData;
                $seriesData = [];
            }
        }else{
            $seriesData['name'] = 'TIDAK ADA';
            $seriesData['y'][] = 0;

            $series[] = $seriesData;
            $seriesData = [];
        }


        return json_encode([
            'series'    => $series,
            'tahun'     => $tahun,
        ]);
    }

}
