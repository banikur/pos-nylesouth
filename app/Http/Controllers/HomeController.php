<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class HomeController extends Controller
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
        $data['data'] =  DB::table('master_produk')
        ->Join('master_kategori', 'master_kategori.kode_kategori', 'master_produk.kode_kategori')
        ->orderby('master_produk.created_at', 'DESC')
        ->limit(3)
        ->get();
        $retVal = (Auth::user()->tipe_user == 1) ? 'home' : 'welcome';
        return view($retVal,$data);
    }
}
