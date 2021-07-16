@extends('template.perusahaan.main')
@section('content')
<div class="card card-custom min-h-lg-800px">
    <div class="card-header">
        <div class="card-title">
            <h3 class="card-label">Master Promo</h3>
        </div>
        <div class="card-toolbar">
            <button type="button" data-toggle="modal" data-target="#modal-tambah" class="btn btn-sm btn-primary font-weight-bolder"><i class="la la-plus"></i>&nbsp; Promo</button>
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
                <h2>Data Master Promo</h2>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-checkable" id="tb_basic">
                        <thead>
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Kode Promo</th>
                                <th scope="col">Potongan Harga</th>
                                <th scope="col">Masa Berlaku</th>
                                <th scope="col"><center>Status Promo</center></th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $data = get_master_promo();
                            $no = 1; $datenow=date('Y-m-d');?>
                            @foreach($data as $d)
                            <tr>
                                <td>{{$no++}}</td>
                                <td>{{$d->kode_promo}}</td>
                                <td>Rp {{number_format($d->potongan_harga,2,',','.')}}</td>
                                <td>{{($d->tgl_mulai) ? tgl_indo($d->tgl_mulai) : ''}} - {{($d->tgl_berakhir) ? tgl_indo($d->tgl_berakhir) : ''}}</td>
                                @if($datenow >= $d->tgl_mulai && $datenow <= $d->tgl_berakhir)
                                <td><center><span class="badge badge-success">Aktif</span></center></td>
                                @else
                                <td><center><span class="badge badge-danger">Expired</span></center></td>
                                @endif
                                <td>
                                    <button class="btn btn-light btn-icon btn-circle btn-sm" data-item="{{json_encode($d)}}" onclick="edit(this)" data-toggle="tooltip" title="Edit"><i class="flaticon2-edit text-primary"></i></button>
                                    <button class="btn btn-light btn-icon btn-circle btn-sm" data-id="{{$d->id_promo}}" onclick="hapus(this)" data-toggle="tooltip" title="Hapus"><i class="flaticon2-trash text-danger"></i></button>
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
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addTitleModal">Tambah Promo</h5>
                <button type="button" class="close" onclick="reset()" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <form id="formTambah" method="post" action="{{route('master.form.modal.action.s_promo')}}">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Kode Promo</label>
                                <input type="text" class="form-control" id="kode_promo" name="kode_promo" placeholder="Kode Promo" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Tanggal Mulai</label>
                                <input type="text" class="form-control" id="tgl_mulai" name="tgl_mulai" placeholder="Tanggal Mulai" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Potongan Harga</label>
                                <input type="text" class="form-control rupiah" id="potongan_harga" name="potongan_harga" placeholder="Potongan Harga" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Tanggal Berakhir</label>
                                <input type="text" class="form-control" id="tgl_berakhir" name="tgl_berakhir" placeholder="Tanggal Berakhir" readonly="true" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger font-weight-bold" onclick="reset()" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary font-weight-bold">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addTitleModal">Tambah Promo</h5>
                <button type="button" class="close" onclick="reset()" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <form id="formEdit" method="post" action="{{route('master.form.modal.action.e_promo')}}">
                @csrf
                <div class="modal-body">
                    <input type="hidden" id="id_promo" name="id_promo">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Tanggal Mulai</label>
                                <input type="text" class="form-control" id="tgl_mulai_e" name="tgl_mulai" placeholder="Tanggal Mulai" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Tanggal Berakhir</label>
                                <input type="text" class="form-control" id="tgl_berakhir_e" name="tgl_berakhir" placeholder="Tanggal Berakhir" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger font-weight-bold" onclick="reset()" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary font-weight-bold">Simpan</button>
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

        $('.rupiah').inputmask({
            alias: "decimal",
            digits: 0,
            repeat: 24,
            digitsOptional: false,
            decimalProtect: true,
            groupSeparator: ".",
            placeholder: '0',
            rightAlign: false,
            radixPoint: ",",
            radixFocus: true,
            autoGroup: true,
            autoUnmask: false,
            onBeforeMask: function(value, opts) {
                return value;
            },
            removeMaskOnSubmit: true
        });
    });

    flatpickr("#tgl_mulai", {
        altInput: true,
        altFormat: "F j, Y",
        dateFormat: "Y-m-d",
    });

    flatpickr("#tgl_mulai_e", {
        altInput: true,
        altFormat: "F j, Y",
        dateFormat: "Y-m-d",
    });

    flatpickr("#tgl_berakhir_e", {
        altInput: true,
        altFormat: "F j, Y",
        dateFormat: "Y-m-d",
    });
    
    $('#tgl_mulai').change(function(){
        var tgl_mulai = $('#tgl_mulai').val();
        console.log(tgl_mulai);
        $('#tgl_berakhir').attr('readonly',false);
        flatpickr("#tgl_berakhir", {
            altInput: true,
            altFormat: "F j, Y",
            dateFormat: "Y-m-d",
            minDate: tgl_mulai,
        })
    });


    function edit(obj) {
        var item = $(obj).data('item');

        $('#id_promo').val(item.id_promo);
        flatpickr("#tgl_mulai_e").setDate(item.tgl_mulai);
        flatpickr("#tgl_berakhir_e").setDate(item.tgl_berakhir);

        $('#modal-edit').modal('show');
    }

    function hapus(obj){
        var id_promo = $(obj).data('id');
        Swal.fire({
                title: 'Hapus produk ini ?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#5cb85c',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya',
                cancelButtonText: 'Batal',
                allowOutsideClick: false,
            }).then((result) => {
                if (result.value) {
                    window.location.href = "{{ URL::to('master/promo/hapus')}}"+'/'+id_promo;
                } else {
                    Swal.fire({
                        title: "Batal Hapus Data",
                        type: "error",
                        allowOutsideClick: false,
                    })
                }
            })
    }
</script>
@endsection