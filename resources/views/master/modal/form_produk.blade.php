<form id="formAdd" method="post" action="{{route('produk.s_produk')}}" enctype="multipart/form-data" autocomplete="off" role="form">
    @csrf
    <div class="modal-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Nama Produk </label>
                    <input type="text" class="form-control form-control-sm" id="nama_produk" name="nama_produk" placeholder="Nama Produk" value="" />
                    <!-- <span class="form-text text-muted">Masukan Nama Produk</span> -->
                </div>
                <div class="form-group">
                    <label>Kategori Produk </label>
                    <select name="kategori_produk" id="kategori_produk" class="form-control select2" style="width: 100%">
                        <option selected disabled></option>
                        <?php $data_kat = get_master_kategori(); ?>
                        @foreach($data_kat as $dat)
                        <option value="{{$dat->kode_kategori}}">{{$dat->nama_kategori}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Harga Produk </label>
                    <input type="text" class="form-control form-control-sm dec" id="harga_produk" name="harga_produk" placeholder="Harga Produk" value="" />
                </div>
                <div class="form-group">
                    <label>Stok Awal Produk </label>
                    <input type="text" class="form-control form-control-sm bul" id="stok_awal_produk" name="stok_awal_produk" placeholder="Stok Awal Produk" value="" />
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Berat Produk </label>
                    <input type="text" class="form-control form-control-sm dec" id="berat_produk" name="berat_produk" placeholder="Berat Produk" value="" />
                </div>
                <div class="form-group">
                    <label class="col-3 ">Ukuran Produk</label>
                    <div class="col-9 col-form-label">
                        <div class="checkbox-inline">
                            <?php $data_uk = get_master_ukuran(); ?>
                            @foreach($data_uk as $uk)
                            <label class="checkbox">
                                <input type="checkbox" name="ukuran[]" value="{{$uk->nama_ukuran}}" />
                                <span></span>
                                {{$uk->nama_ukuran}}
                            </label>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-3">Warna Produk</label>
                    <div class="col-9 col-form-label">
                        <div class="checkbox-inline">
                            <?php $data_war = get_master_warna(); ?>
                            @foreach($data_war as $war)
                            <label class="checkbox">
                                <input type="checkbox" name="warna[]" value="{{$war->nama_warna}}" />
                                <span></span>
                                {{$war->nama_warna}}
                            </label>
                            @endforeach
                        </div>
                    </div>
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
                    <textarea type="text" class="form-control form-control-sm" id="deskripsi_produk" name="deskripsi_produk" placeholder=""></textarea>
                </div>
            </div>
            <div class="col-md-6">
            <label>Gambar Produk </label>
                <div class="dropzone dropzone-default dropzone-primary dz-clickable" id="kt_dropzone_test_user">
                    <div class="dropzone-msg dz-message needsclick">
                        <h3 class="dropzone-msg-title">Letakkan file di sini atau klik untuk mengupload.</h3>
                        <span class="dropzone-msg-desc">Pastikan file yang anda upload .jpeg / .png, Max 2 MB</span>
                    </div>
                </div>
            </div>
            <div id="cumulate_sk_iup_user"></div>
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
                refresh();
            }
        })
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
            $('#cumulate_sk_iup_user').append('<input type="hidden" name="image[]" value="' + response.name + '">')
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