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
                    <input type="text" class="form-control form-control-sm" id="harga_produk" name="harga_produk" placeholder="Harga Produk" value="" />
                </div>

            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Berat Produk </label>
                    <input type="text" class="form-control form-control-sm" id="berat_produk" name="berat_produk" placeholder="Berat Produk" value="" />
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
            <div class="col-md-12">
                <!-- <div class="form-group">
                    <label>Deskripsi Produk </label>
                </div> -->
                <div class="form-group">
                    <label>Deskripsi Produk </label>
                    <textarea type="text" class="form-control form-control-sm" id="deskripsi_produk" name="deskripsi_produk" placeholder=""></textarea>
                </div>
            </div>
            <div class="separator separator-dashed my-5"></div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Stok Awal Produk </label>
                    <input type="text" class="form-control form-control-sm" id="stok_awal_produk" name="stok_awal_produk" placeholder="Stok Awal Produk" value="" />
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-3">Status</label>
                    <div class="col-9 col-form-label">
                        <div class="radio-inline">
                            <label class="radio">
                                <input type="radio" name="radios5[]" checked value="1" />
                                <span></span>
                                Tersedia
                            </label>
                            <label class="radio">
                                <input type="radio" name="radios5[]" value="0" />
                                <span></span>
                                Belum Tersedia
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-danger font-weight-bold" onclick="reset()" data-dismiss="modal">Tutup</button>
            <button type="button" onclick="confirm()" class="btn btn-primary font-weight-bold">Simpan</button>
        </div>
</form>

<script>
    $('.select2').select2({
        placeholder: "- Pilih -",
        allowClear: true,
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
        // if ($('#kategori').val() != null) {

        // } else {
        //     Swal.fire({
        //         title: "Text tidak boleh kosong",
        //         type: "error",
        //         allowOutsideClick: false,
        //     })
        //     $('#kategori').focus();
        // }
    }
</script>