@extends('template.perusahaan.main')
@section('content')
<div class="card card-custom min-h-lg-800px">
    <div class="card-header">
        <div class="card-title">
            <h3 class="card-label">Data Pemesanan</h3>
        </div>
        <!-- <div class="card-toolbar">
            <a onclick="add('add',this)" class="btn btn-sm btn-primary font-weight-bolder"><i class="la la-plus"></i>&nbsp; Pelanggan</a>
            &nbsp;&nbsp;&nbsp;
            <a onclick="add('add_existing',this)" class="btn btn-sm btn-success font-weight-bolder"><i class="la la-plus"></i>&nbsp;Buat Pengajuan Perubahan Exisiting</a>
        </div> -->
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12 ">
                <!-- Data Table -->
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-checkable" id="tb_basic">
                        <thead>
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Nomor Pesanan</th>
                                <th scope="col">Nama Pelanggan</th>
                                <th scope="col">Kode Produk / Jumlah / Harga</th>
                                <th scope="col">Total</th>
                                <th scope="col">Alamat</th>
                                <th scope="col">Status</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $data = get_master_pesanan();
                            $no = 1; ?>
                            @foreach($data as $d)
                            <?php $detail = get_master_pesanan_detail($d->kode_trx_pemesanan, $d->kode_pelanggan); $kode = explode('/',$d->kode_trx_pemesanan)?>
                            <tr>
                                <td>{{$no++}}</td>
                                <td>{{$kode[1]}}</td>
                                <td>{{$d->name}}</td>
                                <td>
                                    @foreach($detail as $il)
                                    <ul>
                                        <li>{{$il->kode_produk}} / {{$il->jumlah}} / {{$il->sub_total}}</li>
                                    </ul>
                                    @endforeach
                                </td>
                                <td>Rp {{number_format($d->total_harga,2,',','.')}}</td>
                                <td>{{ $d->alamat }}</td>
                                <td>
                                    @if($d->status_pemesanan == 0) {{-- Pesanan Baru --}}
                                        <span class="badge badge-warning">Verifikasi</span>
                                    @elseif($d->status_pemesanan == 1) {{-- Proses Ditolak --}}
                                        <span class="badge badge-danger">Ditolak</span>
                                    @elseif($d->status_pemesanan == 2) {{-- Pesanan Terverifikasi --}}
                                        <span class="badge badge-success">Terverifikasi</span>
                                    @elseif($d->status_pemesanan == 3) {{-- Proses Pengiriman --}}
                                        <span class="badge badge-primary">Proses Pengiriman</span>
                                    @elseif($d->status_pemesanan == 4) {{-- Terkirim --}}
                                        <span class="badge badge-secondary">Terkirim</span>
                                    @endif
                                </td>
                                <td>
                                    <button class="btn btn-light btn-icon btn-circle btn-sm" data-item="{{json_encode($d)}}" onclick="verif(this)" data-toggle="tooltip" title="Update"><i class="flaticon2-edit text-warning"></i></button>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
                <!-- Data Table -->
            </div>
        </div>
        <br />
    </div>
</div>

<div class="modal fade" id="modal-verifikasi" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showTitleModal">Modal Title</h5>
                <button type="button" class="close" onclick="refresh()" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div id="show_body">
                <form id="form-pembayaran" method="post" action="{{route('init.verifikasi_pemesanan')}}">
                    @csrf
                    <div class="modal-body">
                        <div class="card card-custom">
                            <div class="card-body">
                                <div class="row">
                                    <input type="hidden" id="kode_trx_pemesanan" name="kode_trx_pemesanan">
                                    <input type="hidden" id="kode_pelanggan" name="kode_pelanggan">
                                    <input type="hidden" id="kurir" name="kurir">
                                    <input type="hidden" id="biaya_kirim" name="biaya_kirim">
                                    <div class="col-md-12" id="s_form_warna">
                                        <div class="row">
                                            <label class="col-3 col-form-label">Nama Pelanggan</label>
                                            <div class="col-8">
                                                <label id="nama_pelanggan" class="col-form-label"></label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label class="col-3 col-form-label">No.Handphone</label>
                                            <div class="col-8">
                                                <label id="telp" class="col-form-label"></label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label class="col-3 col-form-label">Alamat</label>
                                            <div class="col-8">
                                                <label id="alamat" class="col-form-label"></label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label class="col-3 col-form-label">Transfer Atas Nama</label>
                                            <div class="col-8">
                                                <label id="tf_an" class="col-form-label"></label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label class="col-3 col-form-label">Catatan</label>
                                            <div class="col-8">
                                                <label id="catatan" class="col-form-label"></label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label class="col-3 col-form-label">Bukti Pembayaran</label>
                                            <div class="col-8">
                                                <a href="" target="_blank" id="bukti" class="btn btn-sm btn-dark">Lihat</a>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">Nama Penerima</label>
                                            <div class="col-8">
                                                <input type="text" class="form-control" id="nama_penerima" name="nama_penerima" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">No.Handphone Penerima</label>
                                            <div class="col-8">
                                                <input type="text" class="form-control" id="no_penerima" name="no_penerima" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">Alamat Penerima</label>
                                            <div class="col-8">
                                                <input type="text" class="form-control" id="alamat_penerima" name="alamat_penerima" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">Status</label>
                                            <div class="col-8">
                                                <select class="form-control" id="status" name="status" onchange="changeStatus();">
                                                    <option value="0">Verifikasi</option>
                                                    <option value="1">Ditolak</option>
                                                    <option value="2">Terverifikasi</option>
                                                    <option value="3">Proses Pengiriman</option>
                                                    <option value="4">Terkirim</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row" id="no_resi_div">
                                            <label class="col-3 col-form-label">Nomor Resi</label>
                                            <div class="col-8">
                                                <input type="text" class="form-control" id="no_resi" name="no_resi" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="btnSimpan" class="btn btn-primary font-weight-bold">Simpan</button>
                        <button type="button" class="btn btn-danger font-weight-bold" onclick="refresh()" data-dismiss="modal">Tutup</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
@section('js')
<script>
    $(document).ready(function() {
        $('#tb_basic').DataTable();
        changeStatus();
    });

    function add(cmd, obj) {
        var item = $(obj).data('item');

        if (cmd == 'add') {
            $('#addTitleModal').text('Tambah Pelanggan');
            $('#existing').hide();
            $('#btn_add_more_direksi').show();
        } else {
            $('#addTitleModal').text('Buat Pengajuan Existing');
            $('#existing').show();
            $('#btn_add_more_direksi').hide();
        }
        $('#modal-tambah').modal('show');
    }

    function verif(obj) {
        
        var item = $(obj).data('item');
        var kode = item.kode_trx_pemesanan.split('/');
        $('#showTitleModal').text('Pembayaran Nomor Pesanan ' + kode[1]);
        $.get("{{URL::to('verifikasi/daftar-pesanan/get-pembayaran')}}",
        {
            kode_trx_pemesanan:item.kode_trx_pemesanan,
            kode_pelanggan:item.kode_pelanggan,
        },function(data){
            $('#nama_pelanggan').text(data.nama[0].name);
            $('#tf_an').text(data.pembayaran[0].transfer_atas_nama);
            $('#catatan').text(data.pembayaran[0].notes);
            $('#bukti').attr('href','{{url('')}}'+data.pembayaran[0].pembayaran_foto_folder_path);
            $('#no_resi').val(data.pengiriman[0].nomor_resi);
        })
        if(item.status_pemesanan == 4){
            $('#btnSimpan').hide();
        }

        $('#telp').text(item.no_hp);
        $('#alamat').text(item.alamat);
        $('#kode_trx_pemesanan').val(item.kode_trx_pemesanan);
        $('#kode_pelanggan').val(item.kode_pelanggan);
        $('#kurir').val(item.kurir);
        $('#biaya_kirim').val(item.biaya_kirim);
        $('#status').val(item.status_pemesanan);
        $('#modal-verifikasi').modal('show');

        changeStatus();
    }

    function changeStatus(){
        var status = $('#status').val();
        if(status == 3 || status == 4){
            $('#no_resi_div').show();
        }else{
            $('#no_resi_div').hide();
        }
    }

    function reset() {
        document.getElementById("formAdd").reset();
    }
</script>
@endsection