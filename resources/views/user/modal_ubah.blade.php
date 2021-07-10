<form id="formAdd" method="post" action="{{route('transaksi.update_modal_cart')}}">
    @csrf
    <div class="modal-body">
        <div class="row">
            <div class="col-sm-6">
                <div class="portfolio-item">
                    <?php $data_pict = get_picture_array($initial_product); ?>
                    <div id="slider" class="owl-carousel product-details-slider">
                        @foreach($data_pict as $dp)
                        <?php $images = $dp->path_file . $dp->nama_file; ?>
                        <div class="item">
                            <img src="{{url($images)}}" />
                        </div>
                        @endforeach
                    </div>
                </div>
                <div id="thumbs" class="owl-carousel product-details-thumb">
                    @foreach($data_pict as $dp_t)
                    <?php $images_thumb = $dp_t->path_file . $dp_t->nama_file; ?>
                    <div class="thumb">
                        <img src="{{url($images_thumb)}}" />
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="col-sm-6 product-details">
                <?php $data_produk = get_master_produk_id($initial_product); ?>
                <h4>{{$data_produk->nama_produk}}</h4>
                <div class="price">
                    <!-- <span class="price-was">$959.99</span> $999.99 -->
                    IDR {{number_format($data_produk->harga_produk,2,',','.')}}
                </div>
                <h5>Deskripsi Singkat</h5>
                <p>
                    {{$data_produk->deskripsi_produk}}
                </p>
                <table class="shop-item-selections">
                    <tr>
                        <td><b>Warna:</b></td>
                        <td>
                            <div class="dropdown">
                                <?php $get_detail_warna_id = get_detail_warna_id($initial_product); ?>
                                <select class="form-control select2" name="kode_warna" id="kode_warna">
                                    @foreach($get_detail_warna_id as $wrn)
                                    <option value="{{$wrn->warna}}"> {{master_kode_warna_id($wrn->warna)}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><b>Ukuran:</b></td>
                        <td>
                            <div class="dropdown">
                                <?php $get_detail_ukuran_id = get_detail_ukuran_id($initial_product); ?>
                                <select class="form-control select2" name="kode_ukuran" id="kode_ukuran">
                                    @foreach($get_detail_ukuran_id as $ukrn)
                                    <option value="{{$ukrn->ukuran}}"> {{$ukrn->ukuran}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><b>Jumlah:</b></td>
                        <td>
                            <input type="number" class="form-control input-sm input-micro" name="jumlah" id="jumlah">
                            <input type="hidden" class="form-control input-sm input-micro" value="{{$id_cart}}" name="id_cart" id="id_cart">
                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>
                            <a onclick="update_modal()" class="btn btn"><i class="icon-shopping-cart icon-white"></i> Ubah Pesanan</a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger font-weight-bold" onclick="refresh()" data-dismiss="modal">Batal</button>
        <button type="button" onclick="update_modal()" class="btn btn-primary font-weight-bold">Simpan</button>
    </div>
</form>


<script>
    function update_modal() {
        event.preventDefault(); // prevent form submit
        var form = event.target.form; // storing the form
        Swal.fire({
            title: 'Hapus produk ini ?',
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
                    title: "Batal Ubah Data",
                    type: "error",
                    allowOutsideClick: false,
                })
                refresh();
            }
        })

    }
</script>