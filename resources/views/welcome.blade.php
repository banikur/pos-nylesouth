@extends('template.landing_page.main')
@section('css')
<script src="{{url('js/sweetalert2/dist/sweetalert2.all.min.js')}}"></script>
<script src="{{url('js/sweetalert2/dist/sweetalert2.min.js')}}"></script>
<link rel="stylesheet" href="{{url('js/sweetalert2/dist/sweetalert2.min.css')}}">
@endsection
@section('content')

<?php
$data = get_master_produk();
?>
@foreach($data as $d)
<div class="col-sm-4">
    <div class="shop-item">
        <?php
        $pict = get_picture_id($d->initial_produk);
        $images = $pict->path_file . $pict->nama_file;
        $disc = ((10 * $d->harga_produk) / 100) + $d->harga_produk;
        ?>
        <div class="image">
            <a href="#"><img src="{{url($images)}}" alt="Item Name"></a>
        </div>
        <div class="title">
            <h3><a href="#">{{$d->nama_produk}}</a></h3>
        </div>
        <div class="price">
            <span class="price-was">{{number_format($disc,2,',','.')}}</span>
        </div>
        <div class="price">
            Now Only {{number_format($d->harga_produk,2,',','.')}}
        </div>
        <div class="description">
            <p>{{get_desc_id($d->initial_produk)}}</p>
        </div>
        <div class="actions">
            <a onclick="post_keranjang(this)" data-item="{{$d->initial_produk}}" class="btn"><i class="icon-shopping-cart icon-white"></i> Add to Cart</a>
            <span>or <a href="{{route('detail',['id_produk'=>base64_encode($d->initial_produk)])}}">Read more</a></span>
        </div>
    </div>
</div>
@endforeach

@endsection
@section('javascripts')

<script>
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
        var ip = get_ip();
        @if(Auth::check())
        var auth = "{{Auth::user()->id}}";
        $.ajax({
            url: "{{route('user.add_keranjang')}}",
            type: "post",
            data: {
                id: id,
                auth: auth,
                _token: "{{ csrf_token() }}"
            },
            beforeSend: function() {
                $('#loader').show();
            },
            success: function(data) {
                // console.log(data);
                Swal.fire({
                    title: "Berhasil Tambahkan Ke Keranjang",
                    icon: "success",
                    allowOutsideClick: false,
                })
                $('#loader').hide();
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