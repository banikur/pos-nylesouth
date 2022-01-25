@extends('template.perusahaan.main')
@section('content')
<div class="card card-custom min-h-lg-800px">
    <div class="card-header">
        <div class="card-title">
            <h3 class="card-label">Master Pelanggan</h3>
        </div>
        <div class="card-toolbar">
            <!-- <a onclick="add('add',this)" class="btn btn-sm btn-primary font-weight-bolder"><i class="la la-plus"></i>&nbsp; Pelanggan</a>
            &nbsp;&nbsp;&nbsp; -->
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
                <h2>Data Pelanggan</h2>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-checkable" id="tb_basic">
                        <thead>
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Nama Pelanggan</th>
                                <th scope="col">Alamat</th>
                                <th scope="col">No Telp.</th>
                                <th scope="col">E-Mail</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $data = get_master_pelanggan();
                            $no = 1; ?>
                            @foreach($data as $d)
                            <tr>
                                <td>{{$no++}}</td>
                                <td>{{$d->name}}</td>
                                <td>{{$d->alamat}}</td>
                                <td>{{$d->no_hp}}</td>
                                <td><a href="mailto:{{$d->email}}">{{$d->email}}</a></td>
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

    function reset() {
        document.getElementById("formAdd").reset();
    }
</script>
@endsection