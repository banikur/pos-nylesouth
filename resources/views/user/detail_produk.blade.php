@extends('template.landing_page.main_2')
@section('css')
<style>
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
</style>
@endsection
@section('content')
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
                    <input type="hidden" class="form-control input-sm input-micro" value="{{$initial_product}}" name="kode_produk" id="kode_produk">
                </td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>
                    <a onclick="post_keranjang(this)" data-item="{{$initial_product}}" class="btn btn"><i class="icon-shopping-cart icon-white"></i> Add to Cart</a>
                </td>
            </tr>
        </table>
    </div>
</div>
@endsection
@section('javascripts')
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
<script src="{{url('select2/js/select2.min.js')}}"></script>
<script src="{{url('js/bootstrap-number-input.js')}}"></script>

<script src='https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js'></script>
<script src="{{url('plugin/owl_carousel/script.js')}}"></script>
<script>
    $('.select2').select2();

    function get_ip() {
        var tmp = null;
        $.ajax({
            async: false,
            url: "//api.ipify.org/?format=json",
            dataType: 'JSON',
        }).success(function(data) {
            // console.log(data.ip);
            tmp = data.ip;
        }).error(function(jqXHR, textStatus, errorThrown) {
            console.log(jqXHR);
            console.log(textStatus);
            console.log(errorThrown);
        })
    }
    var item = [];

    function post_keranjang(obj) {
        var id = $(obj).data('item');
        var jumlah = $('#jumlah').val();
        var kode_ukuran = $('#kode_ukuran :selected').val();
        var kode_warna = $('#kode_warna :selected').val();

        var ip = get_ip();
        @if(Auth::check())
        var auth = "{{Auth::user()->id}}";
        $.ajax({
            url: "{{route('user.add_keranjang')}}",
            type: "post",
            data: {
                id: id,
                auth: auth,
                jumlah: jumlah,
                kode_ukuran: kode_ukuran,
                kode_warna: kode_warna,
                _token: "{{ csrf_token() }}"
            },
            beforeSend: function() {
                $('#loader').show();
            },
            success: function(data) {
                console.log(data);
                if (data.response == "200") {
                    Swal.fire({
                        title: "Berhasil Tambahkan Ke Keranjang",
                        icon: "success",
                        allowOutsideClick: false,
                    })
                    $('#loader').hide();
                } else {

                }

                // refresh();
            }
        });
        @else
        // var arr = ['id_produk' => id];
        // item.push(id)
        Swal.fire({
            title: "Anda Harus Mendaftar / Login Untuk Melakukan Transaksi",
            icon: "warning",
            allowOutsideClick: false,
        })
        setTimeout(function() {
            window.location.href = "{{url('login')}}";
        }, 3000);
        // sessionStorage.setItem('id_produk', item);
        // console.log(item);
        @endif
    }
</script>
@endsection