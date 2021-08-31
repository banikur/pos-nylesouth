@extends('template.perusahaan.main')
@section('content')
<div class="card card-custom min-h-lg-800px">
    <div class="card-header">
        <div class="card-title">
            <h3 class="card-label">Data Retur Pelanggan</h3>
        </div>
        <!-- <div class="card-toolbar">
            <a onclick="add('add',this)" class="btn btn-sm btn-primary font-weight-bolder"><i class="la la-plus"></i>&nbsp; Pelanggan</a>
            &nbsp;&nbsp;&nbsp;
            <a onclick="add('add_existing',this)" class="btn btn-sm btn-success font-weight-bolder"><i class="la la-plus"></i>&nbsp;Buat Pengajuan Perubahan Exisiting</a>
        </div> -->
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 ">
                <!-- Data Table -->
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-checkable" id="tb_basic">
                        <thead>
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Kode Produk</th>
                                <th scope="col">Nama Pelanggan</th>
                                <th scope="col">Jumlah Pesanan</th>
                                <th scope="col">Status Return</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php $data = get_data_return();
                            $no = 1; ?>
                            @foreach($data as $d)
                            <tr>
                                <td>{{$no++}}</td>
                                <td>{{$d->kode_produk}}</td>
                                <td>{{$d->name}}</td>
                                <td>{{$d->jumlah}}</td>
                                <td>
                                    @if($d->status_retur == 0)
                                        <span class="badge badge-warning">Pengajuan Return</span>
                                    @elseif($d->status_retur == 1)
                                        <span class="badge badge-success">Approve</span>
                                    @elseif($d->status_retur == 2)
                                        <span class="badge badge-danger">Tolak</span>
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
                <h5 class="modal-title" id="showTitleModal">Return Barang</h5>
                <button type="button" class="close" onclick="refresh()" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div id="show_body">
                <form id="form-pembayaran" method="post" action="{{route('init.verifikasi_return')}}">
                    @csrf
                    <div class="modal-body">
                        <div class="card card-custom">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="hidden" name="kode_retur" id="kode_retur">
                                        <input type="hidden" name="kode_produk" id="kode_produk_val">
                                        <input type="hidden" name="kode_ukuran" id="kode_ukuran_val">
                                        <input type="hidden" name="kode_warna" id="kode_warna_val">
                                        <input type="hidden" name="jumlah" id="jumlah_val">
                                        <div class="row">
                                            <label class="col-3 col-form-label">Nama Pelanggan</label>
                                            <div class="col-8">
                                                <label id="nama" class="col-form-label"></label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label class="col-3 col-form-label">No. Handphone</label>
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
                                            <label class="col-3 col-form-label">Kode Produk</label>
                                            <div class="col-8">
                                                <label id="kode_produk" class="col-form-label"></label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label class="col-3 col-form-label">Jumlah</label>
                                            <div class="col-8">
                                                <label id="jumlah" class="col-form-label"></label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label class="col-3 col-form-label">Alasan</label>
                                            <div class="col-8">
                                                <label id="alasan" class="col-form-label"></label>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">Status</label>
                                            <div class="col-8">
                                                <select class="form-control" id="status" name="status">
                                                    <option value="0">Pengajuan Return</option>
                                                    <option value="1">Approve</option>
                                                    <option value="2">Tolak</option>
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
        
        $('#kode_retur').val(item.kode_retur);
        $('#nama').text(item.name);
        $('#telp').text(item.no_hp);
        $('#alamat').text(item.alamat);
        $('#kode_produk').text(item.kode_produk);
        $('#jumlah').text(item.jumlah);
        $('#alasan').text(item.alasan_retur);
        $('#status').val(item.status_retur);
        
        $('#kode_produk_val').val(item.kode_produk);
        $('#kode_warna_val').val(item.kode_warna);
        $('#kode_ukuran_val').val(item.kode_ukuran);
        $('#jumlah_val').val(item.jumlah);

        $('#modal-verifikasi').modal('show');

    }

    function reset() {
        document.getElementById("formAdd").reset();
    }
</script>
@endsection