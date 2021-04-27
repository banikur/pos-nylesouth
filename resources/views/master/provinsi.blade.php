@extends('template.perusahaan.main')
@section('content')
<div class="card card-custom min-h-lg-800px">
    <div class="card-header">
        <div class="card-title">
            <h3 class="card-label">Master Provinsi & Kabupaten / Kota</h3>
        </div>
        <div class="card-toolbar">
            <a onclick="add('add',this)" class="btn btn-sm btn-primary font-weight-bolder"><i class="la la-plus"></i>&nbsp; Provinsi & Kabupaten / Kota</a>
            &nbsp;&nbsp;&nbsp;
            <!-- <a onclick="add('add_existing',this)" class="btn btn-sm btn-success font-weight-bolder"><i class="la la-plus"></i>&nbsp;Buat Pengajuan Perubahan Exisiting</a> -->
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 ">
                <!-- Data Table -->
                <h2>Data Provinsi & Kabupaten / Kota</h2>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-checkable" id="tb_basic">
                        <thead>
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Nama Kabupaten / Kota</th>
                                <th scope="col">Nama Provinsi</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php $data = get_master_kabkota_prov();
                            $no = 1; ?>
                            @foreach($data as $d)
                            <tr>
                                <td>{{$no++}}</td>
                                <td>{{$d->kab_kota}}</td>
                                <td>{{$d->nama_prov}}</td>
                                <td></td>
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
<div class="modal fade" id="modal-tambah" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addTitleModal">Modal Title</h5>
                <button type="button" class="close" onclick="reset()" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <form id="formAdd" method="post" action="">
                @csrf
                <div class="modal-body">
                    <div class="row" id="existing">
                        <div class="mb-2 col-md-12">
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label text-right">Nama Pengurus Existing:</label>
                                <div class="col-lg-6">
                                    <select name="existing_dirkom" id="existing_dirkom" class="form-control" style="width: 100%">
                                        <option selected disabled></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="separator separator-dashed my-5"></div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class='input-group' id='kt_daterangepicker_2'>
                                    <input type='text' class="form-control" id="tab5_periode" readonly placeholder="Periode Dari" />
                                    <input type="hidden" id="tgl_mulai_periode" name="tgl_mulai_periode" />
                                    <input type="hidden" id="tgl_selesai_periode" name="tgl_selesai_periode" />

                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="la la-calendar-check-o"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-10">
                                        <!-- <input type="text" class="form-control form-control-lg" id="tab5_npwp_direksi" name="tab5_npwp_direksi" value="" placeholder="Nomor NPWP" value="" /> -->
                                        <input class="form-control npwp_perseorangan npwp" placeholder="Nomor NPWP" id="tab5_npwp_direksi" name="tab5_npwp_direksi" type="text" maxlength="20" autocomplete="off">
                                        <span class="form-text text-muted">Masukan No. NPWP tanpa symbol titik(.) dan dash (-)</span>
                                    </div>
                                    <div class="col-md-1">
                                        <button type="button" id="btn_npwp_direksi" class="btn btn-icon btn-warning" onclick="return ceknpwpz();"><i class="flaticon2-search"></i></button>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <input type="text" class="form-control form-control-lg" id="tab5_nama_npwp_direksi" name="tab5_nama_npwp_direksi" placeholder="Nama NPWP" value="" />
                                <span class="form-text text-muted">Masukan Nama Sesuai NPWP</span>
                            </div>

                            <div class="form-group">
                                <textarea class="form-control form-control-lg" style="height: 135px !important; resize:none;" id="tab5_alamat_direksi" name="tab5_alamat_direksi" placeholder="Alamat"></textarea>
                                <span class="form-text text-muted">Masukan Alamat Sesuai NPWP</span>
                            </div>


                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <select name="tab5_jenis_identitas" id="tab5_jenis_identitas" class="form-control" style="width: 100%">
                                    <option selected disabled></option>
                                    <option value="1">KTP</option>
                                    <option value="2">PASSPORT</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <input type="text" class="form-control form-control-lg" id="tab5_nomor_identitas_direksi" name="tab5_nomor_identitas_direksi" placeholder="Nomor Identitas" value="" />
                            </div>
                            <div class="form-group">
                                <select name="tab5_jabatan" id="tab5_jabatan" class="form-control" style="width: 100%">
                                </select>
                            </div>

                            <div class="form-group">
                                <input type="email" class="form-control form-control-lg" style="text-transform: lowercase;" id="tab5_email_direksi" name="tab5_email_direksi" placeholder="E-Mail" value="" />
                            </div>

                            <div class="form-group">
                                <input type="text" class="form-control form-control-lg bulat" id="tab5_telp_direksi" name="tab5_telp_direksi" placeholder="081 XXX XXX" value="" />
                            </div>

                            <div class="form-group">
                                <select name="tab5_negara_direksi" id="tab5_negara_direksi" class="form-control" style="width: 100%">
                                    <option></option>
                                </select>
                            </div>

                            <div class="form-group">
                                <button type="button" id="btn_add_more_direksi" class="btn btn-dark float-right"><i class="flaticon2-plus"></i> Tambah</button>
                                <input type="hidden" class="form-control form-control-lg" style="display:hidden;" value="0" id="count" name="count" />
                            </div>
                        </div>
                    </div>
                    <hr />
                    <div class="row">
                        <div id="formRPembelianR" class="col-md-12">
                            <div class="row batasRemove"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger font-weight-bold" onclick="reset()" data-dismiss="modal">Tutup</button>
                    <button type="submit" onclick="confirm()" class="btn btn-primary font-weight-bold">Simpan</button>
                </div>
            </form>
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
            $('#addTitleModal').text('Tambah Provinsi & Kabupaten / Kota');
            $('#existing').hide();
            $('#btn_add_more_direksi').show();
        } else {
            $('#addTitleModal').text('Buat Pengajuan Existing');
            $('#existing').show();
            $('#btn_add_more_direksi').hide();
        }
        $('#modal-tambah').modal('show');
    }

    function reset() {
        document.getElementById("formAdd").reset();
    }
</script>
@endsection