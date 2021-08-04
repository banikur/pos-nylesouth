@extends('template.perusahaan.main')
@section('content')
<div class="card card-custom min-h-lg-800px">
    <div class="card-header">
        <div class="card-title">
            <h3 class="card-label">Data Pengiriman</h3>
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
                                <th scope="col">Nama Penerima</th>
                                <th scope="col">No. Handphone Penerima</th>
                                <th scope="col">Alamat Penerima</th>
                                <th scope="col">Kurir / Biaya</th>
                                <th scope="col">Status</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $data = get_master_pengiriman();
                            $no = 1; ?>
                            @foreach($data as $d)
                            <?php $kode = explode('/',$d->kode_trx_pemesanan)?>
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $kode[1] }}</td>
                                <td>{{ $d->nama_penerima }}</td>
                                <td>{{ $d->no_hp_penerima }}</td>
                                <td>{{ $d->alamat_kirim }}</td>
                                <td>{{ $d->kurir }} / Rp {{$d->biaya_kirim}}</td>
                                <td>
                                    @if($d->status_pengiriman == 0) {{-- Pesanan Proses Pengiriman --}}
                                        <span class="badge badge-primary">Proses Pengiriman</span>
                                    @elseif($d->status_pengiriman == 1) {{-- Proses Terkirim --}}
                                        <span class="badge badge-secondary">Terkirim</span>
                                    @elseif($d->status_pengiriman == 2) {{-- Pesanan Pesanan Diterima --}}
                                        <span class="badge badge-success">Pesanan Diterima</span>
                                    @elseif($d->status_pengiriman == 3) {{-- Selesai --}}
                                        <span class="badge badge-primary">Selesai</span>
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
                <form id="form-pembayaran" method="post" action="{{route('init.verifikasi_pengiriman')}}">
                    @csrf
                    <div class="modal-body">
                        <div class="card card-custom">
                            <div class="card-body">
                                <div class="row">
                                    <input type="hidden" id="kode_trx_pemesanan" name="kode_trx_pemesanan">
                                    <div class="col-md-12" id="s_form_warna">
                                        <div class="row">
                                            <label class="col-3 col-form-label">Nama Penerima</label>
                                            <div class="col-8">
                                                <label id="nama_penerima" class="col-form-label"></label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label class="col-3 col-form-label">No. Handphone Penerima</label>
                                            <div class="col-8">
                                                <label id="telp" class="col-form-label"></label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label class="col-3 col-form-label">Alamat Penerima</label>
                                            <div class="col-8">
                                                <label id="alamat" class="col-form-label"></label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label class="col-3 col-form-label">Kurir</label>
                                            <div class="col-8">
                                                <label id="kurir" class="col-form-label"></label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label class="col-3 col-form-label">No. Resi</label>
                                            <div class="col-8">
                                                <label id="no_resi" class="col-form-label"></label>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">Status</label>
                                            <div class="col-8">
                                                <select class="form-control" id="status" name="status">
                                                    <option value="0">Proses Pengiriman</option>
                                                    <option value="1">Terkirim</option>
                                                    <option value="2">Pesanan Diterima</option>
                                                    <option value="3">Selesai</option>
                                                </select>
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
        var kurir = item.kurir+' / '+item.biaya_kirim;
        $('#nama_penerima').text(item.nama_penerima);
        $('#telp').text(item.no_hp_penerima);
        $('#alamat').text(item.alamat_kirim);
        $('#kode_trx_pemesanan').val(item.kode_trx_pemesanan);
        $('#kurir').text(kurir);
        $('#no_resi').text(item.nomor_resi);
        $('#status').val(item.status_pengiriman);
        $('#modal-verifikasi').modal('show');

    }

    function reset() {
        document.getElementById("formAdd").reset();
    }
</script>
@endsection