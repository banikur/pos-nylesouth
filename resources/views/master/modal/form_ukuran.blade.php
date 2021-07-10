<form id="sform_ukuran" method="post" action="">
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
                    <div class="col-md-12" id="s_form_ukuran" style="display: none;">
                        <div class="form-group row">
                            <label class="col-2 col-form-label">Jenis ukuran</label>
                            <div class="col-8">
                                <input class="form-control" type="hidden" id="id_ukuran" name="id_ukuran" />
                                <input class="form-control" type="text" value="" id="ukuran" name="ukuran" placeholder="Ukuran" maxlength="5" />
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
                            <table class="table table-bordered table-hover table-checkable" id="tb_basic_ukuran">
                                <thead>
                                    <tr>
                                        <th scope="col">No.</th>
                                        <th scope="col">Kode Ukuran</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <?php $uk = get_master_ukuran();
                                $no = 1; ?>
                                <tbody>
                                    @foreach($uk as $d)
                                    <tr style="text-align: center;vertical-align: middle;">
                                        <td style="width: 2%;">{{$no++}}</td>
                                        <td>{{$d->nama_ukuran}}</td>
                                        <td>
                                            <button type="button" onclick="show_form('edit',this)"  data-id="{{$d->kode_ukuran}}" data-text="{{$d->nama_ukuran}}" class="btn btn-light btn-icon btn-circle btn-sm" data-toggle="tooltip" title="Ubah"><i class="flaticon2-edit text-warning"></i></button>
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
        <!-- <button type="submit" onclick="confirm()" class="btn btn-primary font-weight-bold">Simpan</button> -->
    </div>
</form>

<script>
    $('#tb_basic_ukuran').DataTable();

    function show_form(params, obj) {
        if (params == 'add') {
            $('#s_form_ukuran').show("slow");
            $('#id_ukuran').val('');
            $('#ukuran').val('');
            $('form#sform_ukuran').attr('action', "");
            $('form#sform_ukuran').attr('action', "{{ route('master.form.modal.action.s_ukuran') }}");
        } else if (params == 'edit') {
            var id = $(obj).data('id');
            var text = $(obj).data('text');
            $('#s_form_ukuran').show("slow");
            $('#id_ukuran').val(id);
            $('#ukuran').val(text);
            console.log(text, id);
            $('form#sform_ukuran').attr('action', "");
            $('form#sform_ukuran').attr('action', "{{ route('master.form.modal.action.u_ukuran') }}");
        } else {
            $('#s_form_ukuran').hide("slow");
            $('#id_ukuran').val('');
            $('#ukuran').val('');
            $('form#sform_ukuran').attr('action', "");
        }
    }

    function confirm() {
        if ($('#ukuran').val() != null) {
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
            $('#ukuran').focus();
        }

    }
</script>