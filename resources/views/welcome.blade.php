@extends('template.landing_page.main')
@section('css')
@endsection
@section('content')
<div class="row">
    <div class="col-sm-4">
        <div class="shop-item">
            <div class="image">
                <a href="page-product-details.html"><img src="{{url('landing_page/img/product1.jpg')}}" alt="Item Name"></a>
            </div>
            <div class="title">
                <h3><a href="page-product-details.html">Lorem ipsum dolor</a></h3>
            </div>
            <div class="colors">
                <span class="color-white"></span>
                <span class="color-black"></span>
            </div>
            <div class="price">
                $999.99
            </div>
            <div class="description">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse mattis, nulla id pretium malesuada, dui est laoreet risus, ac rhoncus eros diam id odio.</p>
            </div>
            <div class="actions">
                <a href="page-product-details.html" class="btn"><i class="icon-shopping-cart icon-white"></i> Add to Cart</a>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="shop-item">
            <div class="image">
                <a href="page-product-details.html"><img src="{{url('landing_page/img/product2.jpg')}}" alt="Item Name"></a>
            </div>
            <div class="title">
                <h3><a href="page-product-details.html">Lorem ipsum dolor</a></h3>
            </div>
            <div class="price">
                $999.99
            </div>
            <div class="description">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse mattis, nulla id pretium malesuada, dui est laoreet risus, ac rhoncus eros diam id odio.</p>
            </div>
            <div class="actions">
                <a href="page-product-details.html" class="btn"><i class="icon-shopping-cart icon-white"></i> Add to Cart</a> <span>or <a href="page-product-details.html">Read more</a></span>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="portfolio-item">
            <div class="portfolio-image">
                <a href="page-portfolio-item.html"><img src="{{url('landing_page/img/portfolio3.jpg')}}" alt="Project Name"></a>
            </div>
            <div class="portfolio-info">
                <ul>
                    <li class="portfolio-project-name">Project Name</li>
                    <li>Website design & Development</li>
                    <li>Client: Some Client LTD</li>
                    <li class="read-more"><a href="page-portfolio-item.html" class="btn">Read more</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php
$data = get_master_produk();
?>
@for($i = 0; $i < Count($data);$i++) @if($i % 3) <div class="row">
    <div class="col-sm-4">
        <div class="shop-item">
            <?php
            $pict = get_picture_id($data[$i]->initial_produk);
            // dd($pict);
            $images = $pict->path_file . $pict->nama_file;
            $disc = ((10 * $data[$i]->harga_produk) / 100) + $data[$i]->harga_produk;
            ?>
            <div class="image">
                <a href="page-product-details.html"><img src="{{url($images)}}" alt="Item Name"></a>
            </div>
            <div class="title">
                <h3><a href="page-product-details.html">{{$data[$i]->nama_produk}}</a></h3>
            </div>

            <div class="price">
                <span class="price-was">{{number_format($disc,2,',','.')}}</span>
            </div>
            <div class="price">
                Now Only {{number_format($data[$i]->harga_produk,2,',','.')}}
            </div>
            <div class="description">
                <p>{{get_desc_id($data[$i]->initial_produk)}}</p>
            </div>
            <div class="actions">
                <button type="button" onclick="add_cart('{{$data[$i]->initial_produk}}')" class="btn"><i class="icon-shopping-cart icon-white"></i> Add to Cart</button> <span>or <a href="page-product-details.html">Read more</a></span>
            </div>
        </div>
    </div>
    </div>
    @endif

    @endfor
    @endsection
    @section('javascripts')

    <script>
        @auth
        var user_sess = true;
        @else
        var user_sess = false;
        @endif
        function add_cart(user_sess) {
            if (user_sess) {
                console.log(user_sess);
            } else {
                console.log(user_sess);
            }
           
        }
    </script>
    @endsection