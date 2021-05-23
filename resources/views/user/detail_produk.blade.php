@extends('template.landing_page.main')
@section('css')
<script src="{{url('js/sweetalert2/dist/sweetalert2.all.min.js')}}"></script>
<script src="{{url('js/sweetalert2/dist/sweetalert2.min.js')}}"></script>


<link rel="stylesheet" href="{{url('js/sweetalert2/dist/sweetalert2.min.css')}}">
<!-- <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css'> -->
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css'>
<!-- <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css'> -->
<link rel="stylesheet" href="{{url('plugin/owl_carousel/style.css')}}">
<link href="{{url('select2/css/select2.css')}}" rel="stylesheet" />
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
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. In convallis tempor libero quis sollicitudin. Nunc convallis semper lorem eget accumsan. Phasellus consectetur consequat risus, sed vestibulum felis tincidunt id. Integer in lacinia purus, vitae tempor risus. Aliquam dignissim eros eget elit fringilla venenatis.
        </p>
        <table class="shop-item-selections">
            <tr>
                <td><b>Color:</b></td>
                <td>
                    <div class="dropdown">
                        <?php $get_detail_warna_id = get_detail_warna_id($initial_product); ?>
                        <select class="form-control select2">
                            @foreach($get_detail_warna_id as $wrn)
                            <option value="{{$wrn->warna}}"> {{$wrn->warna}}</option>
                            @endforeach
                        </select>
                    </div>
                </td>
            </tr>
            <tr>
                <td><b>Size:</b></td>
                <td>
                    <div class="dropdown">
                        <?php $get_detail_ukuran_id = get_detail_ukuran_id($initial_product); ?>
                        <select class="form-control select2">
                            @foreach($get_detail_ukuran_id as $ukrn)
                            <option value="{{$ukrn->ukuran}}"> {{$ukrn->ukuran}}</option>
                            @endforeach
                        </select>
                    </div>
                </td>
            </tr>
            <tr>
                <td><b>Quantity:</b></td>
                <td>
                    <input type="number" class="form-control input-sm input-micro" value="1">
                </td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>
                    <a href="#" class="btn btn"><i class="icon-shopping-cart icon-white"></i> Add to Cart</a>
                </td>
            </tr>
        </table>
    </div>
</div>
@endsection
@section('javascripts')
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
<script src="{{url('select2/js/select2.min.js')}}"></script>
<script src="{{url('js/bootstrap-number-input.js')}}" ></script>

<!-- <script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js'></script> -->
<script src='https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js'></script>
<script src="{{url('plugin/owl_carousel/script.js')}}"></script>
<script>
    $('.select2').select2();
</script>
@endsection