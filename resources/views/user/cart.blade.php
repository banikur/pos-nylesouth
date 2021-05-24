@extends('template.landing_page.main_2')
@section('css')
@endsection
@section('content')
<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!-- Action Buttons -->
                <div class="pull-right">
                    <a href="#" class="btn btn-grey"><i class="glyphicon glyphicon-refresh"></i> UPDATE</a>
                    <a href="#" class="btn"><i class="glyphicon glyphicon-shopping-cart icon-white"></i> CHECK OUT</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <!-- Shopping Cart Items -->
                <table class="shopping-cart">
                    @foreach($data as $d)
                    <tr>
                        <?php
                        $pict = get_picture_id($d->kode_produk);
                        $images = $pict->path_file . $pict->nama_file;
                        ?>
                        <td class="image"><a href="{{route('detail',['id_produk'=>base64_encode($d->kode_produk)])}}"><img src="{{url($images)}}" alt="Item Name"></a></td>
                        <td>
                            <?php
                            $data_produk = get_master_produk_id(base64_encode($d->kode_produk));
                            ?>
                            <div class="cart-item-title"><a href="page-product-details.html">{{$data_produk->nama_produk}}</a></div>
                            <div class="feature color">
                                Warna: {{get_warna_id($d->kode_warna)->nama_warna}}
                            </div>
                            <div class="feature">Ukuran: <b>{{$d->kode_ukuran}}</b></div>
                        </td>
                        <td class="quantity">
                            <input class="form-control input-sm input-micro" type="text" value="{{$d->total}}">
                        </td>
                        <td class="price">{{number_format($data_produk->harga_produk,2,',','.')}}</td>
                        <td class="actions">
                            <a class="btn btn-xs btn-orange"><i class="glyphicon glyphicon-pencil"></i></a>
                            <a class="btn btn-xs btn-red"><i class="glyphicon glyphicon-trash"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="cart-shippment-options">
                    <h6><i class="glyphicon glyphicon-plane"></i> Shippment options</h6>
                    <div class="input-append">
                        <select class="form-control input-sm select2">
                            <option value="jne">JNE</option>
                            <option value="pos">PT Pos Indonesia</option>
                            <option value="tiki">TIKI</option>
                        </select>
                    </div>
                </div>
                <div class="cart-shippment-options">
                    <h6><i class="glyphicon glyphicon-plane"></i> Provinsi</h6>
                    <div class="input-append">
                        <select class="form-control input-sm select2" id="provinsi">
                            <?php $data_prov = get_master_prov();
                            $no = 1; ?>
                            @foreach($data_prov as $prov)
                            <option value="{{$prov->id_api}}">{{$prov->nama_prov}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="cart-shippment-options">
                    <h6><i class="glyphicon glyphicon-plane"></i> Kota / Kabupaten</h6>
                    <div class="input-append">
                        <select class="form-control input-sm select2" id="kab_kota">

                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="cart-promo-code">
                    <h6><i class="glyphicon glyphicon-gift"></i> Kode Pos</h6>
                    <div class="input-group">
                        <input class="form-control input-sm" id="kode_pos" readonly type="text" value="">
                    </div>
                </div>
                <div class="cart-promo-code">
                    <h6><i class="glyphicon glyphicon-gift"></i> Have a promotion code?</h6>
                    <div class="input-group">
                        <input class="form-control input-sm" id="appendedInputButton" type="text" value="">
                        <span class="input-group-btn">
                            <button class="btn btn-sm btn-grey" type="button">Apply</button>
                        </span>
                    </div>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-md-12 col-md-offset-0 col-sm-12">
                <table class="cart-totals">
                    <tr>
                        <td><b>Shipping</b></td>
                        <td>Free</td>
                    </tr>
                    <tr>
                        <td><b>Discount</b></td>
                        <td>- $18.00</td>
                    </tr>
                    <tr class="cart-grand-total">
                        <td><b>Total</b></td>
                        <td><b>$163.55</b></td>
                    </tr>
                </table>
                <!-- Action Buttons -->
                <div class="pull-right">
                    <a href="#" class="btn btn-grey"><i class="glyphicon glyphicon-refresh"></i> UPDATE</a>
                    <a href="#" class="btn"><i class="glyphicon glyphicon-shopping-cart icon-white"></i> CHECK OUT</a>
                </div>
            </div>
        </div>
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
    $('#provinsi').on('change', function() {
        var json = null;
        var id = this.value;

        $.get('{{URL::to("master_kab_kota")}}/' + id, function(data) {
            $('#kab_kota').val(null).trigger('change');
            json = JSON.parse(data);
            var test = null;
            test =
                "<option disabled='' selected='' value='0'>-PILIH-</option>";
            for (i = 0; i < json.length; i++) {
                test += "<option data-item='" + json[i].kode_pos + "' value='" + json[i].id_api + "'>" + json[i].kab_kota + "</option>";
            }
            $('#kab_kota').html(test);
        });

    });
    $('#kab_kota').on('change', function() {
        var kode_pos = $(this).find(':selected').data('item');
        $('#kode_pos').val(kode_pos);
    });
</script>
@endsection