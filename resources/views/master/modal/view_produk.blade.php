<form id="formshow" method="post" action="" enctype="multipart/form-data" autocomplete="off" role="form">
    @csrf
    <div class="modal-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Nama Produk </label>
                    <label></label>
                </div>
                <div class="form-group">
                    <label>Kategori Produk </label>
                </div>
                <div class="form-group">
                    <label>Berat Produk </label>
                </div>
                <div class="form-group">
                    <label>Harga Produk </label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Deskripsi Produk </label>
                </div>

            </div>
        </div>
        <div class="row">
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
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        @foreach($detail as $d)
                        <tr>
                            <td>{{$no++}}</td>
                            <td>{{$d->id_detail_produk}}</td>
                            <td>{{$d->ukuran}}</td>
                            <td>{{$d->warna}}</td>
                            <td>{{get_stok($d->id_detail_produk)}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            @foreach($picture as $p)
            <div class="col-md-3">
                <div class="shop-item">
                    <!-- Product Image -->
                    <div class="image">
                        <img src=" {{asset($p->path_file . $p->nama_file)}}" alt="{{$p->nama_file}}">
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-danger font-weight-bold" onclick="reset()" data-dismiss="modal">Tutup</button>
        <!-- <button type="button" onclick="confirm()" class="btn btn-primary font-weight-bold">Simpan</button> -->
    </div>
</form>
<script src="{{url('demo2/src/js/pages/crud/file-upload/dropzonejs.js?v=7.0.6')}}"></script>

<script>
    $('#tb_basic1').DataTable();
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
</script>