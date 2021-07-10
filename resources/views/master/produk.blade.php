@extends('template.perusahaan.main')
@section('css')
<style>
    .shop-item {
        position: relative;
        background: #FFF;
        margin-top: 20px;
        margin-bottom: 20px;
        border: 8px solid #FFF;
        -webkit-border-radius: 5px;
        -webkit-background-clip: padding-box;
        -moz-border-radius: 5px;
        -moz-background-clip: padding;
        border-radius: 5px;
        background-clip: padding-box;
        -webkit-box-shadow: inset 0 1px #fff, 0 0 8px #c8cfe6;
        -moz-box-shadow: inset 0 1px #fff, 0 0 8px #c8cfe6;
        box-shadow: inset 0 1px #fff, 0 0 8px #c8cfe6;
        color: inset 0 1px #fff, 0 0 8px #c8cfe6;
    }

    .shop-item .image {
        text-align: center;
    }

    .shop-item img {
        max-width: 100%;
    }
</style>
@endsection
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
                                <td>{{get_master_kategori_id($d->kode_kategori)}}</td>
                                <td>{{$d->nama_produk}}</td>
                                <td>IDR {{number_format($d->harga_produk,2,',','.')}}</td>
                                <td>
                                    <button class="btn btn-light btn-icon btn-circle btn-sm" onclick="show('{{base64_encode($d->initial_produk)}}',this)" data-id="{{$d->initial_produk}}" data-toggle="tooltip" title="Detail"><i class="flaticon2-search text-primary"></i></button>
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

<div class="modal fade" id="modal-show" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showTitleModal">Modal Title</h5>
                <button type="button" class="close" onclick="refresh()" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div id="show_div">
                <div id="loader2" class="spinner spinner-danger spinner-lg mr-15 mt-8"></div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
    $(document).ready(function() {
        var table2 = $('#tb_basic').DataTable();
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

    function show(item, obj) {
        console.log(obj);
        var initial = $(obj).data('id');
        $('#showTitleModal').text('Detail Produk ' + initial);
        $.ajax({
            url: "{{route('master.form.modal.detail_produk')}}",
            data: {
                id: item,
                _token: "{{ csrf_token() }}"
            },
            beforeSend: function() {
                $('#loader2').show();
            },
            complete: function() {
                $('#loader2').hide();
            },
            success: function(data) {
                $('#show_div').html(data);
            },
            error: function(data) {

            }
        });
        $('#modal-show').modal('show');
    }

    function add(cmd, obj) {
        var item = $(obj).data('item');

        if (cmd == 'add') {
            $('#addTitleModal').text('Tambah Produk');
            $.ajax({
                url: "{{route('master.form.modal.produk')}}",
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
                url: "{{route('master.form.modal.ukuran')}}",
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
                url: "{{route('master.form.modal.warna')}}",
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
                url: "{{route('master.form.modal.kategori')}}",
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