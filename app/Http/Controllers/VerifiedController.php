<?php

namespace App\Http\Controllers;

use App\Http\Middleware\TrimStrings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use DB;
use Illuminate\Support\Facades\Auth;
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
        $data['data'] =  DB::table('master_produk')
            ->Join('master_kategori', 'master_kategori.kode_kategori', 'master_produk.kode_kategori')
            ->orderby('master_produk.created_at', 'DESC')
            ->limit(3)
            ->get();
        return view('welcome', $data);
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
        try {

            $insert = DB::table('keranjang_belanja')->insert(
                [
                    'kode_produk' => base64_decode($request->id),
                    'kode_ukuran' => $request->kode_ukuran,
                    'kode_pelanggan' => Auth::user()->id,
                    'kode_warna' => $request->kode_warna,
                    'jumlah' => $request->jumlah,
                    'created_at' => date('Y-m-d H:i:s'),
                ]
            );
            if ($insert) {
                $success['response'] = '200';
                $success['text'] = 'Success';
                $success["message"] = "Berhasil";
            } else {
                $success['response'] = '500';
                $success['text'] = 'Error';
                $success["message"] = "Terjadi Masalah";
            }
            return response()->json($success);
        } catch (QueryException $e) {
            $success['response'] = '500';
            $success['text'] = 'Error Query Database';
            $success["message"] = $e->getMessage();
            return response()->json($success);
        }
    }

    public function testapi(Request $request)
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/province",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "key: 1eb78fdd90b0ca6ee740c48c9c8de45f"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {

            $res = json_decode($response, true);
            // dd($res['rajaongkir']['results']);
            $collection = $res['rajaongkir']['results'];
            foreach ($collection as $key) {
                $search = DB::table('master_provinsi')->where('nama_prov', $key['province'])->get();
                if ($search) {
                    DB::table('master_provinsi')->where('nama_prov', $key['province'])->update(
                        [
                            'id_api' => $key['province_id']
                        ]
                    );
                }
            }
            echo $response;
        }
    }

    public function testapi2()
    {
        for ($i = 0; $i < 35; $i++) {
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://api.rajaongkir.com/starter/city?province=" . $i,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => array(
                    "key: 1eb78fdd90b0ca6ee740c48c9c8de45f"
                ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            $res = json_decode($response, true);
            $collection = $res['rajaongkir']['results'];

            foreach ($collection as $key) {
                $type = ($key['type'] == 'Kabupaten') ? 'KAB.' : (($key['type'] == 'Kota') ? 'KOTA' : $key['type']);

                $search = DB::table('master_kab_kota')->where('kab_kota', $type . ' ' . strtoupper($key['city_name']))->get();

                if ($search) {
                    DB::table('master_kab_kota')->where('kab_kota', $type . ' ' . strtoupper($key['city_name']))->update(
                        [
                            'id_api' => $key['city_id'],
                            'kode_pos' => $key['postal_code'],
                            'id_provinsi_api' => $key['province_id']
                        ]
                    );
                }
            }

            if ($err) {
                echo "cURL Error #:" . $err;
            } else {
                echo $response;
            }
        }
    }

    public function master_kab_kota($id)
    {
        $getdata = get_master_kab_kota($id);
        echo $getdata;
    }
}
