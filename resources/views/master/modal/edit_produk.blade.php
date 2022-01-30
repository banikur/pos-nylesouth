<form id="formAdd" method="post" action="{{route('master.form.modal.action.e_produk')}}" enctype="multipart/form-data" autocomplete="off" role="form">
    @csrf
    <div class="modal-body">
        <div class="row">
            <input type="hidden" name="initial_produk" value="{{$produk->initial_produk}}">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Nama Produk </label>
                    <input type="text" class="form-control form-control-sm" id="nama_produk" name="nama_produk" placeholder="Nama Produk" value="{{ $produk->nama_produk }}"/>
                </div>
                <div class="form-group">
                    <label>Kategori Produk </label>
                    <select name="kategori_produk" id="kategori_produk" class="form-control select2" style="width: 100%">
                        <option selected disabled></option>
                        <?php $data_kat = get_master_kategori(); ?>
                        @foreach($data_kat as $dat)
                        <option value="{{$dat->kode_kategori}}" @if($dat->kode_kategori == $produk->kode_kategori) selected @endif>{{$dat->nama_kategori}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Berat Produk </label>
                    <input type="text" class="form-control form-control-sm dec" id="berat_produk" name="berat_produk" placeholder="Berat Produk" value="{{ number_format($produk->berat_produk,2,',','.') }}" />
                </div>
                <div class="form-group">
                    <label>Harga Produk </label>
                    <input type="text" class="form-control form-control-sm dec" id="harga_produk" name="harga_produk" placeholder="Harga Produk" value="{{ number_format($produk->harga_produk,2,',','.') }}" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <!-- <div class="form-group">
                    <label>Deskripsi Produk </label>
                </div> -->
                <div class="form-group">
                    <label>Deskripsi Produk </label>
                    <textarea type="text" rows="4" class="form-control form-control-sm" id="deskripsi_produk" name="deskripsi_produk" placeholder="">{{ $produk->deskripsi_produk }}</textarea>
                </div>
            </div>
        </div>
        <div class="separator separator-dashed separator-border-2 separator-dark"></div>
        <div class="row" style="margin-top: 20px;">
            <div class="card-body">
                <div class="row">
                    @foreach($picture as $p)
                    <div class="col-md-3">
                        <div class="shop-item">
                            <!-- Product Image -->
                            <div class="image">
                                <img src=" {{asset($p->path_file . $p->nama_file)}}" alt="{{$p->nama_file}}">
                            </div>
                            {{-- <input type="file" name="image[]" value=""> --}}
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="separator separator-dashed separator-border-2 separator-dark"></div>
        <div class="row" style="margin-top: 20px;">
            <div class="card-body">
                <h4>Stok Produk</h4>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-checkable" id="tb_basic1">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Kode Produk</th>
                                <th>Ukuran</th>
                                <th>Warna</th>
                                <th>Stok</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            @foreach($detail as $key => $d)
                            <input type="hidden" name="id_detail_produk_temp[]" value="{{ $d->id_detail_produk }}"/>
                            <tr id="tr_{{$key}}">
                                <td>{{$no++}}</td>
                                <td><input type="hidden" name="id_detail_produk[]" value="{{ $d->id_detail_produk }}"/>{{ $d->id_detail_produk }}</td>
                                <td>
                                    <select class="form-control select2" style="width: 100%" name="ukuran[]">
                                        @foreach ($ukuran as $val)
                                            <option value="{{$val->nama_ukuran}}" @if($d->ukuran == $val->nama_ukuran) selected @endif>{{$val->nama_ukuran}}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <select class="form-control select2" style="width: 100%" name="warna[]">
                                        @foreach ($warna as $val)
                                            <option value="{{$val->kode_warna}}" @if($d->warna == $val->kode_warna) selected @endif>{{$val->nama_warna}}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td><input type="text" class="form-control form-control-sm" name="stok[]" value="{{ get_stok($d->id_detail_produk) }}"/></td>
                                <td><button type="button" class="btn btn-light btn-icon btn-circle btn-sm" onclick="removeTr('{{$key}}')" data-toggle="tooltip" title="Detail"><i class="flaticon2-trash text-danger"></i></button></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-danger font-weight-bold" onclick="reset()" data-dismiss="modal">Tutup</button>
        <button type="button" onclick="confirm()" class="btn btn-primary font-weight-bold">Simpan</button>
    </div>
</form>
<script src="{{url('demo2/src/js/pages/crud/file-upload/dropzonejs.js?v=7.0.6')}}"></script>

<script>
    $('.select2').select2({
        placeholder: "- Pilih -",
        allowClear: true,
    });
    $('.dec').inputmask({
        alias: "decimal",
        digits: 2,
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

    $('.bul').inputmask({
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

    function removeTr(index)
    {
        $('#tr_'+index+'').closest('tr').remove();
    }

    function confirm() {
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
                // refresh();
            }
        })
    }

    function validate(){
        if($('#nama_produk').val()==''){
            Swal.fire({icon: 'error',title: 'Nama Produk Kosong',showConfirmButton: false,timer: 1500})
            return false
        }else if($('input[name="image[]"]').val() == ''){
            Swal.fire({icon: 'error',title: 'Belum Upload Gambar',showConfirmButton: false,timer: 1500})
            return false
        }else if($('#kategori_produk').val()==null){
            Swal.fire({icon: 'error',title: 'Kategori Produk Kosong',showConfirmButton: false,timer: 1500})
            return false
        }else if($('#harga_produk').val()==''){
            Swal.fire({icon: 'error',title: 'Harga Produk Kosong',showConfirmButton: false,timer: 1500})
            return false
        }else if($('#stok_awal_produk').val()==0){
            Swal.fire({icon: 'error',title: 'Stok Awal Produk Kosong',showConfirmButton: false,timer: 1500})
            return false
        }else if($('#berat_produk').val()==''){
            Swal.fire({icon: 'error',title: 'Berat Produk Kosong',showConfirmButton: false,timer: 1500})
            return false
        }else if($('input[name="ukuran[]"]').is(':checked') == false){
            Swal.fire({icon: 'error',title: 'Ukuran Produk Kosong',showConfirmButton: false,timer: 1500})
            return false
        }else if($('input[name="warna[]"]').is(':checked') == false){
            Swal.fire({icon: 'error',title: 'Warna Produk Kosong',showConfirmButton: false,timer: 1500})
            return false
        }else if($('#deskripsi_produk').val() == ""){
            Swal.fire({icon: 'error',title: 'Deskripsi Produk Kosong',showConfirmButton: false,timer: 1500})
            return false
        }else{
            return true;
        }
    }

</script>
<script>
    Dropzone.autoDiscover = false;
    // multiple file upload
    var uploadedDocumentMap = {};
    $('#kt_dropzone_test_user').dropzone({
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        data: {
            id_users: "{{Auth::user()->id}}",
        },
        url: "{{route('projects.storeMedia')}}", // Set the url for your upload script location
        paramName: "file", // The name that will be used to transfer the file
        maxFiles: 10,
        acceptedFiles: "image/*",
        maxFilesize: 2, // MB
        addRemoveLinks: true,
        params: {
            'id_users': '{{Auth::user()->id}}',
            'id_perusahaan': '{{Auth::user()->id_perusahaan}}',
            'jenis_dokumen': '1',
        },
        success: function(file, response) {
            $('#cumulate_sk_iup_user').html('<input type="hidden" name="image[]" value="' + response.name + '">')
            uploadedDocumentMap[file.name] = response.name
        },
        removedfile: function(file) {
            file.previewElement.remove();

            var name = '';
            if (typeof file.file_name !== 'undefined') {
                name = file.file_name
            } else {
                name = uploadedDocumentMap[file.name]
            }
            $('#cumulate_sk_iup_user').html('<input type="hidden" name="image[]" value="">');
            $('#cumulate_sk_iup_user').find('input[name="sk_iup[]"][value="' + name + '"]').remove()
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                type: 'post',
                data: {
                    id_users: "{{Auth::user()->id}}",
                    nama_dokumen: name,
                    jenis_dokumen: "1",
                },
                url: "{{route('projects.dropzoneRemove')}}",
            });
        },

    });
</script>