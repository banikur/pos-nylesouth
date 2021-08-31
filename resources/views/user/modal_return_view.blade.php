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
                    <?php $get_detail_warna_id = $keranjang; ?>
                    <select class="form-control select2" name="kode_warna" id="kode_warna">
                        <option value="" selected>--Pilih WARNA--</option>
                        @foreach($get_detail_warna_id as $wrn)
                        <option value="{{$wrn->kode_warna}}"> {{master_kode_warna_id($wrn->kode_warna)}}</option>
                        @endforeach
                    </select>
                </div>
            </td>
        </tr>
        <tr>
            <td><b>Ukuran:</b></td>
            <td>
                <div class="dropdown">
                    <?php $get_detail_ukuran_id = $keranjang; ?>
                    <select class="form-control select2" name="kode_ukuran" id="kode_ukuran">
                        <option value="" selected>--Pilih UKURAN--</option>
                        @foreach($get_detail_ukuran_id as $ukrn)
                        <option value="{{$ukrn->kode_ukuran}}"> {{$ukrn->kode_ukuran}}</option>
                        @endforeach
                    </select>
                </div>
            </td>
        </tr>
        <tr>
            <td><b>Jumlah:</b></td>
            <td>
                <input type="text" class="form-control input-sm input-micro" name="jumlah" id="jumlah" readonly>
            </td>
        </tr>
        <tr>
            <td><b>Alasan:</b></td>
            <td>
                <textarea class="form-control" name="alasan" id="alasan"></textarea>
            </td>
        </tr>
    </table>
</div>

<script>
    $('#kode_ukuran').on('change', function() {
        var kode_produk = '{{$kode_produk}}';
        var kode_pelanggan = '{{$kode_pelanggan}}';
        var kode_warna = $('#kode_warna').val();
        var kode_ukuran = $('#kode_ukuran').val();
            $.ajax({
                url: "{{route('transaksi.get_produk_jumlah_in_keranjang')}}",
                data: {
                    kode_pelanggan: kode_pelanggan,
                    kode_produk: kode_produk,
                    kode_warna: kode_warna,
                    kode_ukuran: kode_ukuran,
                },
                success: function(res) {
                    var data = JSON.parse(res);
                    console.log(data);
                    $('#jumlah').val(data.jumlah);
                },
                error: function(data) {
                    // console.log(data);
                }
            });
    });
</script>