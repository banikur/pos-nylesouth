@extends('template.perusahaan.main')
@section('content')
<div class="card card-custom min-h-lg-800px">
    <div class="card-header">
        <div class="card-title">
            <h3 class="card-label">Master Produk</h3>
        </div>
        <div class="card-toolbar">
            <a onclick="add('add',this)" class="btn btn-sm btn-primary font-weight-bolder"><i class="la la-plus"></i>&nbsp; Produk</a>
            &nbsp;&nbsp;&nbsp;
            <a onclick="add('ukuran',this)" class="btn btn-sm btn-primary font-weight-bolder"><i class="la la-plus"></i>&nbsp; Master Ukuran Produk</a>
            &nbsp;&nbsp;&nbsp;
            <a onclick="add('warna',this)" class="btn btn-sm btn-primary font-weight-bolder"><i class="la la-plus"></i>&nbsp; Master Warna Produk </a>
            &nbsp;&nbsp;&nbsp;
            <a onclick="add('kategori',this)" class="btn btn-sm btn-primary font-weight-bolder"><i class="la la-plus"></i>&nbsp; Master Kategori Produk </a>
            &nbsp;&nbsp;&nbsp;
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
                <h2>Data Produk</h2>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-checkable" id="tb_basic">
                        <thead>
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Kode Produk</th>
                                <th scope="col">Kode Kategori</th>
                                <th scope="col">Nama Produk</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php $data = get_master_produk();
                            $no = 1; ?>
                            @foreach($data as $d)
                            <tr style="text-align: center;vertical-align: middle;">
                                <td>{{$no++}}</td>
                                <td>{{$d->initial_produk}}</td>
                                <td>{{$d->nama_kategori}}</td>
                                <td>{{$d->nama_produk}}</td>
                                <td>IDR {{number_format($d->harga_produk,2,',','.')}}</td>
                                <td>
                                    <button class="btn btn-light btn-icon btn-circle btn-sm" data-toggle="tooltip" title="Detail"><i class="flaticon2-search text-primary"></i></button>
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
<div class="modal fade" id="modal-tambah" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addTitleModal">Modal Title</h5>
                <button type="button" class="close" onclick="refresh()" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div id="show_form">
                <div id="loaders" class="spinner spinner-danger spinner-lg mr-15 mt-8"></div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
    $(document).ready(function() {
        $('#tb_basic').DataTable();
        $('#tb_basic thead tr').clone(true).appendTo('#tb_basic thead');
        $('#tb_basic thead tr:eq(1) th').each(function(i) {
            var title = $(this).text();
            if (i == 1 || i == 2 || i == 3 || i == 4) {
                $(this).html('<input type="text" class="form-control" placeholder="Search ' + title + '" />');

                $('input', this).on('keyup change', function() {
                    if (table2.column(i).search() !== this.value) {
                        table2
                            .column(i)
                            .search(this.value)
                            .draw();
                    }
                });
            } else {
                $(this).html('');
            }

        });
    });
    $(function() {
        @if(session('message'))
        Swal.fire({
            text: "{{session()->get('message')}}",
            icon: "success",
            buttonsStyling: false,
            confirmButtonText: "Ok, got it!",
            customClass: {
                confirmButton: "btn font-weight-bold btn-light"
            }
        });
        @endif
        @if(session('error'))
        Swal.fire({
            text: "{{session()->get('error')}}",
            icon: "error",
            buttonsStyling: false,
            confirmButtonText: "Ok, got it!",
            customClass: {
                confirmButton: "btn font-weight-bold btn-light"
            }
        });
        @endif
    });

    function refresh() {
        setTimeout(function() {
            location.reload()
        }, 100);
    }

    function add(cmd, obj) {
        var item = $(obj).data('item');

        if (cmd == 'add') {
            $('#addTitleModal').text('Tambah Produk');
            $.ajax({
                url: "{{route('modal.master.produk')}}",
                beforeSend: function() {
                    $('#loaders').show();
                },
                complete: function() {
                    $('#loaders').hide();
                },
                success: function(data) {

                    $('#show_form').html(data);
                },
                error: function(data) {

                }
            });
            $('#show_form').show();
        } else if (cmd == 'ukuran') {
            $('#addTitleModal').text('Tambah Master Ukuran Produk');
            $.ajax({
                url: "{{route('modal.master.ukuran')}}",
                beforeSend: function() {
                    $('#loaders').show();
                },
                complete: function() {
                    $('#loaders').hide();
                },
                success: function(data) {

                    $('#show_form').html(data);
                },
                error: function(data) {

                }
            });
            $('#show_form').show();
        } else if (cmd == 'warna') {
            $('#addTitleModal').text('Tambah Master Warna Produk');
            $.ajax({
                url: "{{route('modal.master.warna')}}",
                beforeSend: function() {
                    $('#loaders').show();
                },
                complete: function() {
                    $('#loaders').hide();
                },
                success: function(data) {

                    $('#show_form').html(data);
                },
                error: function(data) {

                }
            });
            $('#show_form').show();
        } else if (cmd == 'kategori') {
            $('#addTitleModal').text('Tambah Master Kategori Produk');
            $.ajax({
                url: "{{route('modal.master.kategori')}}",
                beforeSend: function() {
                    $('#loaders').show();
                },
                complete: function() {
                    $('#loaders').hide();
                },
                success: function(data) {
                    //  
                    $('#show_form').html(data);
                },
                error: function(data) {
                    //  
                }
            });
            $('#show_form').show();
        } else {
            $('#addTitleModal').text('Buat Pengajuan Existing');
            $('#show_form').hide();
        }
        $('#modal-tambah').modal('show');
    }

    function reset() {
        document.getElementById("formAdd").reset();
    }
</script>
@endsection