<form id="sform_warna" method="post" action="">
    @csrf
    <div class="modal-body">
        <div class="card card-custom min-h-lg-800px">
            <div class="card-header">
                <div class="card-title">
                    <h3 class="card-label">&nbsp;</h3>
                </div>
                <div class="card-toolbar">
                    <a onclick="show_form('add',this)" class="btn btn-sm btn-primary font-weight-bolder"><i class="la la-plus"></i>&nbsp; Tambah</a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12" id="s_form_warna" style="display: none;">
                        <div class="form-group row">
                            <label class="col-2 col-form-label">Jenis Warna</label>
                            <div class="col-8">
                                <input class="form-control" type="hidden" id="id_warna" name="id_warna" />
                                <input class="form-control" type="text" value="" id="warna" name="warna" placeholder="Warna" />
                            </div>
                            <div class="col-2">
                                <button type="button" onclick="show_form('close',this)" class="btn btn-light btn-icon btn-circle btn-sm" data-toggle="tooltip" title="Tutup"><i class="far fa-window-close text-danger"></i></button>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-10 col-form-label"></label>
                            <div class="col-2">
                                <button type="button" onclick="confirm()" class="btn btn-primary font-weight-bold">Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 ">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-checkable" id="tb_basic_warna">
                                <thead>
                                    <tr>
                                        <th scope="col">No.</th>
                                        <th scope="col">Kode Warna</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <?php $uk = get_master_warna();
                                $no = 1; ?>
                                <tbody>
                                    @foreach($uk as $d)
                                    <tr style="text-align: center;vertical-align: middle;">
                                        <td style="width: 2%;">{{$no++}}</td>
                                        <td>{{$d->nama_warna}}</td>
                                        <td>
                                            <button type="button" onclick="show_form('edit',this)" data-id="{{$d->kode_warna}}" data-text="{{$d->nama_warna}}" class="btn btn-light btn-icon btn-circle btn-sm" data-toggle="tooltip" title="Ubah"><i class="flaticon2-edit text-warning"></i></button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger font-weight-bold" onclick="refresh()" data-dismiss="modal">Tutup</button>
    </div>
</form>

<script>
    function show_form(params, obj) {
        if (params == 'add') {
            $('#s_form_warna').show("slow");
            $('#id_warna').val('');
            $('#warna').val('');
            $('form#sform_warna').attr('action', "");
            $('form#sform_warna').attr('action', "{{ route('master.form.modal.action.s_warna') }}");
        } else if (params == 'edit') {
            var id = $(obj).data('id');
            var text = $(obj).data('text');
            $('#s_form_warna').show("slow");
            $('#id_warna').val(id);
            $('#warna').val(text);
            $('form#sform_warna').attr('action', "");
            $('form#sform_warna').attr('action', "{{ route('master.form.modal.action.u_warna') }}");
        } else {
            $('#s_form_warna').hide("slow");
            $('#id_warna').val('');
            $('#warna').val('');
            $('form#sform_warna').attr('action', "");
        }
    }
    $('#tb_basic_warna').DataTable();
    function confirm() {
        if ($('#warna').val() != null) {
            event.preventDefault(); // prevent form submit
            var form = event.target.form; // storing the form
            // alert(existing);
            Swal.fire({
                title: 'Apakah Data yang di Masukan Sudah Benar ?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#5cb85c',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya',
                cancelButtonText: 'Batal',
                allowOutsideClick: false,
            }).then((result) => {
                if (result.value) {
                    form.submit();
                } else {
                    Swal.fire({
                        title: "Batal Simpan Data",
                        type: "error",
                        allowOutsideClick: false,
                    })
                    refresh();
                }
            })
        } else {
            Swal.fire({
                title: "Text tidak boleh kosong",
                type: "error",
                allowOutsideClick: false,
            })
            $('warna').focus();
        }

    }
</script>