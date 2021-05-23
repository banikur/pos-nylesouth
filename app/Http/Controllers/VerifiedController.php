<?php

namespace App\Http\Controllers;

use App\Http\Middleware\TrimStrings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use DB;
use Datatables;

use App\User;
use Illuminate\Foundation\Console\Presets\React;

class VerifiedController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function index()
    {
        return view('welcome');
    }

    public function cart_index()
    {
        return view('user.cart');
    }
    public function detail_index(Request $request)
    {
        $initial_code = $request->id_produk;
        $data['initial_product'] = $initial_code;
        return view('user.detail_produk', $data);
    }

    public function storeMedia(Request $request)
    {
        $file = $request->file('file');
        $id = $request->id_users;
        $id_perusahaan = $request->id_perusahaan;

        $path = public_path('/uploads/temp/');

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $file = $request->file('file');

        // $name = uniqid() . '_' .  str_replace(' ', '', $file->getClientOriginalName()) . '.' . $file->getClientOriginalExtension();
        $name = uniqid() . '_' .  str_replace(' ', '', $file->getClientOriginalName());

        $file->move($path, $name);
        return response()->json([
            'name'          => $name,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }

    public function dropzoneRemove(Request $request)
    {
        $id = $request->id_users;
        $destinationPath = public_path('/uploads/temp/');
        if ($request->ajax()) {
            if (File::exists($destinationPath . $request->nama_dokumen)) {
                File::delete($destinationPath . $request->nama_dokumen); //Delete file from storage
            } //Check if file exists
            return response('deleted', 200); //return success
        }
    }

    public function loadMedia(Request $request)
    {
        $file_list = array();
        $data = DB::table('pengajuan_perubahan_dokumen')->where('id_perusahaan', $request->id_perusahaan)
            ->get();
        // Target directory
        for ($i = 0; $i < count($data); $i++) {
            $file = $data[$i]->doc_nama_file_ori;
            $file_path = $data[$i]->doc_url . '/' . $data[$i]->doc_nama_file_ori;
            //  $size = filesize($file_path);

            $file_list[] = array('name' => $file, 'path' => $file_path);
        }

        echo json_encode($file_list);
    }

    public function post_keranjang(Request $request)
    {
        dd($request);
    }
}
