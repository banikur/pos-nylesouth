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
                    <a onclick="returnBarang()" class="btn"><i class="glyphicon glyphicon-glyphicon-refresh"></i> RETURN</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <!-- Shopping Cart Items -->
                <table class="shopping-cart">
                    <?php $total=0; ?>
                    @if(!empty($data))
                    @foreach($data as $d)
                    <tr>
                        <?php
                        $pict = get_picture_id($d->kode_produk);
                        $images = $pict->path_file . $pict->nama_file;
                        ?>
                        <input class="form-control total_berat" type="hidden" value="{{ceil($d->total_berat * $d->cart)}}">
                        <input type="hidden" id="total" value="">
                        <td><input type="checkbox" class="form-control" name="select_cart" id="{{$d->kode_produk}}" onchange="setCheckout('{{$d->kode_produk}}')"></td>
                        <td class="image"><a href="{{route('detail',['id_produk'=>base64_encode($d->kode_produk)])}}"><img src="{{url($images)}}" alt="Item Name"></a></td>
                        <td>
                            <?php
                            $data_produk = get_master_produk_id(base64_encode($d->kode_produk));
                            $total_harga = $d->cart * $data_produk->harga_produk;
                            $total += $total_harga;
                            ?>
                            <div class="cart-item-title"><a href="page-product-details.html">{{$data_produk->nama_produk}}</a></div>
                            <div class="feature color">
                                Warna: {{get_warna_id($d->kode_warna)->nama_warna}}
                            </div>
                            <div class="feature">Ukuran: <b>{{$d->kode_ukuran}}</b></div>
                            <div class="feature color">Jumlah: <b>{{$d->cart}}</b></div>
                        </td>
                        {{-- <td class="quantity">
                            <input class="form-control input-sm input-micro quantity" value="{{$d->cart}}">
                        </td> --}}
                        <td class="price">{{number_format($total_harga,2,',','.')}}</td>
                        <td class="actions">
                            @if(empty($d->status))
                            <a class="btn btn-xs btn-orange"data-ukuran="{{$d->kode_ukuran}}" data-warna="{{$d->kode_warna}}" data-qty="{{$d->cart}}" data-item="{{$d->kode_keranjang}}" data-id="{{$d->kode_produk}}" onclick="show('edit',this)"><i class="glyphicon glyphicon-pencil"></i></a>
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
                        <select class="form-control input-sm select2" id="kurir" onchange="kurir()">
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
<div class="modal fade" id="modal-checkout" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addTitleModal">View Checkout</h5>
                <button type="button" class="close" onclick="reset()" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <form id="formCheckout" method="post" action="{{route('transaksi.modal_checkout_cart')}}" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                <div id="data_checkout"></div>
                <div class="row">
                    <input type="hidden" name="total_harga" id="total_harga">
                    <input type="hidden" name="jasa_kurir" id="jasa_kurir">
                    <input type="hidden" name="biaya_kirim" id="biaya_kirim">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="catatan">Tambah Catatan</label>
                            <textarea class="form-control" id="catatan" name="catatan" rows="3"></textarea>
                          </div>
                        <div class="form-group">
                            <label for="tf_an">Transfer Atas Nama</label>
                            <input type="text" class="form-control" id="tf_an" name="tf_an">
                        </div>
                        <div class="form-group">
                            <label for="bukti_tf">Bukti Transfer</label>
                            <input type="file" class="form-control" id="bukti_tf" name="bukti_tf">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger font-weight-bold" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary font-weight-bold">PESAN</button>
            </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-return" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addTitleModalReturn">Modal Title</h5>
                <button type="button" class="close" onclick="reset()" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body" id="munculReturn">
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

    function kurir(){
        var estimasi = $('#kurir').find(':selected').data('estimasi');
        var biaya = $('#kurir').find(':selected').data('biaya');
        var kurir = $('#kurir').find(':selected').text();
        var total = $('#total').val();
        var text = 'Rp. ' + number_format(biaya, 2, '.', ',') + ' - ' + estimasi + ' Hari';
        var rumus_total = parseInt(total) + biaya;

        $('#jasa_kurir').val(kurir);
        $('#biaya_kirim').val(biaya);
        $('#total_harga').val(rumus_total);
        $('#ongkir').html(text);
        $('#total_bayar').html('Rp. ' + number_format(rumus_total, 2, '.', ','));
    }

    $('#dic_btn').on('click', function() {
        var json = null;
        var biaya = $('#kurir').find(':selected').data('biaya');
        var total = $('#total').val();
        var id = $('#appendedInputButton').val();
        if(id){
            $.get('{{URL::to("get_disc")}}/' + btoa(id), function(data) {
                json = JSON.parse(data);
                // var rumus_total = parseInt(total) + biaya - data;
                var jumlah_biaya = parseInt(total) + biaya;
                var jumlah_diskon = data/100 * jumlah_biaya;
                var rumus_total = jumlah_biaya - jumlah_diskon;
                if(json!=0){
                    $('#disc_text').html(number_format(json, 2, ',', '.')+'%');
                    $('#disc_text').attr('style','')
                    $('#total_bayar').html('Rp. ' + number_format(rumus_total, 2, '.', ','));
                }else{ 
                    Swal.fire({
                        icon: 'info',
                        title: 'PROMO SUDAH TIDAK BERLAKU',
                        showConfirmButton: true,
                    })
                    $('#disc_text').html(number_format(0, 2, ',', '.')+'%');
                    $('#disc_text').attr('style','color:red;')
                }
            });
        }else{
            var jumlah_biaya = parseInt(total) + biaya;
            $('#disc_text').html('');
            $('#disc_text').attr('style','');
            $('#total_bayar').html('Rp. ' + number_format(jumlah_biaya, 2, '.', ','));
        }



    });

    function show(cmd, obj) {
        var id_cart = $(obj).data('item');
        var jumlah = $(obj).data('qty');
        var ukuran = $(obj).data('ukuran');
        var warna = $(obj).data('warna');
        if (cmd == 'edit') {
            $('#addTitleModal').text('Ubah jumlah barang');
            $.ajax({
                url: "{{route('transaksi.modal_edit_cart')}}",
                data: {
                    id_cart: id_cart,
                    jumlah: jumlah,
                    ukuran: ukuran,
                    warna: warna,
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
        } else if(cmd == 'hapus') {
            Swal.fire({
                title: 'Hapus produk ini ?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#5cb85c',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya',
                cancelButtonText: 'Batal',
                allowOutsideClick: false,
            }).then((result) => {
                if (result.value) {
                    window.location.href = "{{ URL::to('modal_cart/hapus')}}"+'/'+id_cart;
                } else {
                    Swal.fire({
                        title: "Batal Hapus Data",
                        type: "error",
                        allowOutsideClick: false,
                    })
                }
            })
        }
    }

    function confirm() {
        // var cart = '{{$data}}';
        // if(cart.length > 0){
        //     Swal.fire({
        //         icon: 'info',
        //         title: 'Cart Belum Ada',
        //         showConfirmButton: true,
        //     })
        // }
        if($('#kurir').val() == null){
            Swal.fire({
                icon: 'info',
                title: 'Silahkan Pilih Jasa Pengiriman',
                showConfirmButton: true,
            })
        }else{
            $('#modal-checkout').modal('show');
        }
        
        
        // event.preventDefault(); // prevent form submit
        // var form = event.target.form; // storing the form
        // var existing = $('#existing_dirkom').val();

        // Swal.fire({
        //     title: 'Hapus produk ini ?',
        //     type: 'warning',
        //     showCancelButton: true,
        //     confirmButtonColor: '#5cb85c',
        //     cancelButtonColor: '#d33',
        //     confirmButtonText: 'Ya',
        //     cancelButtonText: 'Batal',
        //     allowOutsideClick: false,
        // }).then((result) => {
        //     if (result.value) {
        //         form.submit();
        //     } else {
        //         Swal.fire({
        //             title: "Batal Ubah Data",
        //             type: "error",
        //             allowOutsideClick: false,
        //         })
        //         // refresh();
        //     }
        // })

    }

    function returnBarang(){
        var kode_pelanggan = '{{Auth::user()->id}}';
        $('#addTitleModalReturn').text('Return Barang');
        $.ajax({
            url: "{{route('transaksi.modal_return_cart')}}",
            data: {
                kode_pelanggan: kode_pelanggan,
            },
            beforeSend: function() {
                $('#loader').css('display', 'block');
            },
            success: function(data) {
                $('#loader').css('display', 'none');
                $('#munculReturn').html(data);
                $('#modal-return').modal('show');
            },
            error: function(data) {
                console.log(data);
            }
        });
    }

    function setCheckout(kode_produk)
    {
        if($('#'+kode_produk+'').is(':checked')){
            var status = 1;
        }else{
            var status = 0;
        }
        var param = kode_produk+'@'+status;
        $.get('{{URL::to("update_barang_checkout")}}/' + param, function(res) {
            var data = JSON.parse(res);
            var html = '';
            console.log(data);

            $.each(data.data, function(i, val){
                html += '<input type="hidden" name="id_keranjang[]" value="'+val.kode_keranjang+'">';
                html += '<input type="hidden" name="kode_produk[]" value="'+val.kode_produk+'">';
                html += '<input type="hidden" name="jumlah[]" value="'+val.jumlah+'">';
                html += '<input type="hidden" class="sub_total" name="sub_total[]" value="'+val.sub_total+'">';
                html += '<input type="hidden" name="id_detail_product[]" value="'+val.id_detail_product+'">';
            })
            $('#data_checkout').html(html);
            $('#total').val(data.total);
            kurir();
        });
    }

    function refresh() {
        window.location.reload();
    }
</script>
@endsection