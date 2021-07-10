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
                    <a onclick="refresh()" class="btn btn-grey"><i class="glyphicon glyphicon-refresh"></i> UPDATE</a>
                    <!-- <a href="#" class="btn"><i class="glyphicon glyphicon-shopping-cart icon-white"></i> CHECK OUT</a> -->
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <!-- Shopping Cart Items -->
                <table class="shopping-cart">
                    @if(!empty($data))
                    @foreach($data as $d)
                    <tr>
                        <?php
                        $pict = get_picture_id($d->kode_produk);
                        $images = $pict->path_file . $pict->nama_file;
                        ?>
                        <input class="form-control total_berat" type="hidden" value="{{ceil($d->total_berat * $d->cart)}}">
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
                            <input class="form-control input-sm input-micro quantity" value="{{$d->cart}}">
                        </td>
                        <td class="price">{{number_format($data_produk->harga_produk,2,',','.')}}</td>
                        <td class="actions">
                            @if(empty($d->status))
                            <a class="btn btn-xs btn-orange" data-qty="{{$d->cart}}" data-item="{{$d->kode_keranjang}}" data-id="{{$d->kode_produk}}" onclick="show('edit',this)"><i class="glyphicon glyphicon-pencil"></i></a>
                            <a class="btn btn-xs btn-red" data-qty="{{$d->cart}}" data-item="{{$d->kode_keranjang}}" data-id="{{$d->kode_produk}}" onclick="show('hapus',this)"><i class="glyphicon glyphicon-trash"></i></a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                    </tr>
                    @endif
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="cart-shippment-options">
                    <h5> Provinsi</h5>
                    <div class="input-append">
                        <select class="form-control input-sm select2" id="provinsi">
                            <option disabled selected>- PILIH -</option>
                            <?php $data_prov = get_master_prov();
                            $no = 1; ?>
                            @foreach($data_prov as $prov)
                            <option value="{{$prov->id_api}}">{{$prov->nama_prov}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="cart-shippment-options">
                    <h5> Kota / Kabupaten</h5>
                    <div class="input-append">
                        <select class="form-control input-sm select2" id="kab_kota">
                            <option disabled selected>- PILIH -</option>
                        </select>
                    </div>
                </div>

            </div>
            <div class="col-md-6">
                <div class="cart-shippment-options">
                    <h5> Pilihan Kurir</h5>
                    <div class="input-append">
                        <select class="form-control input-sm select2" id="kurir">
                            <option disabled selected>- PILIH -</option>
                        </select>
                    </div>
                </div>
                <div class="cart-promo-code">
                    <h5> Kode Pos</h5>
                    <div class="input-group">
                        <input class="form-control input-sm" id="kode_pos" readonly type="text" value="">
                    </div>
                </div>
                <div class="cart-promo-code">
                    <h5> Have a promotion code?</h5>
                    <div class="input-group">
                        <input class="form-control input-sm" id="appendedInputButton" type="text" value="">
                        <span class="input-group-btn">
                            <button class="btn btn-sm btn-grey" id="dic_btn" type="button">Apply</button>
                        </span>
                    </div>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-md-12 col-md-offset-0 col-sm-12">
                <table class="cart-totals">
                    <tr>
                        <td><b>Biaya Pengiriman dan Estimasi</b></td>
                        <td><span id="ongkir"></span></td>
                    </tr>
                    <tr>
                        <td><b>Discount</b></td>
                        <td><span id="disc_text"></span></td>
                    </tr>
                    <tr class="cart-grand-total">
                        <td><b>Total</b></td>
                        <td><b><span id="total_bayar"></span></b></td>
                    </tr>
                </table>
                <!-- Action Buttons -->
                <div class="pull-right">
                    <a onclick="refresh()" class="btn btn-grey"><i class="glyphicon glyphicon-refresh"></i> UPDATE</a>
                    <a onclick="confirm()" class="btn"><i class="glyphicon glyphicon-shopping-cart icon-white"></i> CHECK OUT</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<div class="modal fade" id="modal-tambah" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addTitleModal">Modal Title</h5>
                <button type="button" class="close" onclick="reset()" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body" id="muncul">
            </div>
        </div>
    </div>
</div>
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
        var id_destination = $(this).find(':selected').data('item');
        var kode_pos = $(this).find(':selected').data('item');
        $('#kode_pos').val(kode_pos);
        //get_ongkir_start
        var total_berat = 0;
        $('.total_berat').each(function() {
            total_berat += parseFloat(this.value);
        });

        id_destination = 55;
        total_berat = 1;
        var url1 = "{{URL::to('/get_service_shipping')}}" + "?destination=" + id_destination + "&weight=" + total_berat;
        $.get(url1, function(data) {
            // json = JSON.parse(data);
            // console.log(data.data.length);
            var arr = [];
            var test = null;
            test =
                "<option disabled='' selected='' value='0'>-PILIH-</option>";
            for (i = 0; i < data.data.length; i++) {
                test += "<option data-biaya='" + data.data[i].biaya + "' data-estimasi='" + data.data[i].estimasi + "' value='" + i + "'>" + data.data[i].jenis_pelayanan + "  </option>";
            }
            $('#kurir').html(test);
        });
    });

    $('#kurir').on('change', function() {
        var estimasi = $('#kurir').find(':selected').data('estimasi');
        var biaya = $('#kurir').find(':selected').data('biaya');
        var text = 'Rp. ' + number_format(biaya, 2, '.', ',') + ' - ' + estimasi + ' Hari';
        $('#ongkir').html(text);
    });

    $('#dic_btn').on('click', function() {
        var json = null;
        var id = $('#appendedInputButton').val();
        $.get('{{URL::to("get_disc")}}/' + btoa(id), function(data) {
            json = JSON.parse(data);
            $('#disc_text').html('Rp. ' + number_format(json, 2, ',', '.'));
        });



    });

    function show(cmd, obj) {
        var id_cart = $(obj).data('item');
        if (cmd == 'edit') {
            $('#addTitleModal').text('Ubah jumlah barang');
            $.ajax({
                url: "{{route('transaksi.modal_edit_cart')}}",
                data: {
                    id_cart: id_cart,
                },
                beforeSend: function() {
                    $('#loader').css('display', 'block');
                },
                success: function(data) {
                    $('#loader').css('display', 'none');
                    $('#muncul').html(data);
                    $('#modal-tambah').modal('show');
                },
                error: function(data) {
                    console.log(data);
                }
            });
        } else {

        }
    }

    function confirm() {
        event.preventDefault(); // prevent form submit
        var form = event.target.form; // storing the form
        var existing = $('#existing_dirkom').val();

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

    function refresh() {
        window.location.reload();
    }
</script>
@endsection