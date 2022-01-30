<!DOCTYPE html>
<html class="no-js">
@include('template.landing_page.head.header')
@yield('css')
<script src="{{url('js/sweetalert2/dist/sweetalert2.all.min.js')}}"></script>
<script src="{{url('js/sweetalert2/dist/sweetalert2.min.js')}}"></script>
<link rel="stylesheet" href="{{url('js/sweetalert2/dist/sweetalert2.min.css')}}">
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css'>
<link rel="stylesheet" href="{{url('plugin/owl_carousel/style.css')}}">
<link href="{{url('select2/css/select2.css')}}" rel="stylesheet" />

<body>
    <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->
    <!-- Navigation & Logo-->
    <div class="mainmenu-wrapper">
        <div class="container">
            <div class="menuextras">

            </div>
            <nav id="mainmenu" class="mainmenu">
                <ul>
                    <li class="logo-wrapper"><a href="{{url('/')}}"><img src="landing_page/img/mPurpose-logo.png" alt="Logo"></a></li>
                    <li class="active">
                        <a href="{{route('/')}}">Home</a>
                    </li>

                    <li class="has-submenu" style="display:none;">
                        <a href="#">Pages +</a>
                        <div class="mainmenu-submenu">
                            <div class="mainmenu-submenu-inner">
                                <div>
                                    <h4>Homepage</h4>
                                    <ul>
                                        <li><a href="index.html">Homepage (Sample 1)</a></li>
                                        <li><a href="page-homepage-sample.html">Homepage (Sample 2)</a></li>
                                    </ul>
                                    <h4>Services & Pricing</h4>
                                    <ul>
                                        <li><a href="page-services-1-column.html">Services/Features (Rows)</a></li>
                                        <li><a href="page-services-3-columns.html">Services/Features (3 Columns)</a></li>
                                        <li><a href="page-services-4-columns.html">Services/Features (4 Columns)</a></li>
                                        <li><a href="page-pricing.html">Pricing Table</a></li>
                                    </ul>
                                    <h4>Team & Open Vacancies</h4>
                                    <ul>
                                        <li><a href="page-team.html">Our Team</a></li>
                                        <li><a href="page-vacancies.html">Open Vacancies (List)</a></li>
                                        <li><a href="page-job-details.html">Open Vacancies (Job Details)</a></li>
                                    </ul>
                                </div>
                                <div>
                                    <h4>Our Work (Portfolio)</h4>
                                    <ul>
                                        <li><a href="page-portfolio-2-columns-1.html">Portfolio (2 Columns, Option 1)</a></li>
                                        <li><a href="page-portfolio-2-columns-2.html">Portfolio (2 Columns, Option 2)</a></li>
                                        <li><a href="page-portfolio-3-columns-1.html">Portfolio (3 Columns, Option 1)</a></li>
                                        <li><a href="page-portfolio-3-columns-2.html">Portfolio (3 Columns, Option 2)</a></li>
                                        <li><a href="page-portfolio-item.html">Portfolio Item (Project) Description</a></li>
                                    </ul>
                                    <h4>General Pages</h4>
                                    <ul>
                                        <li><a href="page-about-us.html">About Us</a></li>
                                        <li><a href="page-contact-us.html">Contact Us</a></li>
                                        <li><a href="page-faq.html">Frequently Asked Questions</a></li>
                                        <li><a href="page-testimonials-clients.html">Testimonials & Clients</a></li>
                                        <li><a href="page-events.html">Events</a></li>
                                        <li><a href="page-404.html">404 Page</a></li>
                                        <li><a href="page-sitemap.html">Sitemap</a></li>
                                        <li><a href="page-login.html">Login</a></li>
                                        <li><a href="page-register.html">Register</a></li>
                                        <li><a href="page-password-reset.html">Password Reset</a></li>
                                        <li><a href="page-terms-privacy.html">Terms & Privacy</a></li>
                                        <li><a href="page-coming-soon.html">Coming Soon</a></li>
                                    </ul>
                                </div>
                                <div>
                                    <h4>eShop</h4>
                                    <ul>
                                        <li><a href="page-products-3-columns.html">Products listing (3 Columns)</a></li>
                                        <li><a href="page-products-4-columns.html">Products listing (4 Columns)</a></li>
                                        <li><a href="page-products-slider.html">Products Slider</a></li>
                                        <li><a href="page-product-details.html">Product Details</a></li>
                                        <li><a href="page-shopping-cart.html">Shopping Cart</a></li>
                                    </ul>
                                    <h4>Blog</h4>
                                    <ul>
                                        <li><a href="page-blog-posts.html">Blog Posts (List)</a></li>
                                        <li><a href="page-blog-post-right-sidebar.html">Blog Single Post (Right Sidebar)</a></li>
                                        <li><a href="page-blog-post-left-sidebar.html">Blog Single Post (Left Sidebar)</a></li>
                                        <li><a href="page-news.html">Latest & Featured News</a></li>
                                    </ul>
                                </div>
                            </div><!-- /mainmenu-submenu-inner -->
                        </div><!-- /mainmenu-submenu -->
                    </li>
                    @if (Route::has('login'))

                    @auth
                    <li class="has-submenu">
                        <a href="#">List Retur</a>
                        <div class="mainmenu-submenu">
                            <div class="mainmenu-submenu-inner">
                                <?php $no=1; $dataPemesanan = DB::table('data_retur')->where('kode_pelanggan', Auth::user()->id)->get(); ?>
                                <table class="table table-bordered">
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama Produk</th>
                                        <th>Jumlah</th>
                                        <th>Warna</th>
                                        <th>Ukuran</th>
                                        <th>Alasan Retur</th>
                                        <th><center>Status</center></th>
                                    </tr>
                                    @foreach ($dataPemesanan as $dp)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ get_master_produk_id(base64_encode($dp->kode_produk))->nama_produk }}</td>
                                        <td>{{ $dp->jumlah }}</td>
                                        <td>{{ get_warna_id($dp->kode_warna)->nama_warna }}</td>
                                        <td>{{ $dp->kode_ukuran }}</td>
                                        <td>{{ $dp->alasan_retur }}</td>
                                        <td>
                                            <center>
                                            @if($dp->status_retur == 0)
                                                <span class="label label-warning">Pengajuan Return</span>
                                            @elseif($dp->status_retur == 1)
                                                <span class="label label-success">Approve</span>
                                            @elseif($dp->status_retur == 2)
                                                <span class="label label-danger">Tolak</span>
                                            @endif
                                            </center>
                                        </td>
                                    </tr>
                                    @endforeach
                                </table>
                            </div><!-- /mainmenu-submenu-inner -->
                        </div><!-- /mainmenu-submenu -->
                    </li>
                    <li class="has-submenu">
                        <a href="#">Pesanan Saya</a>
                        <div class="mainmenu-submenu">
                            <div class="mainmenu-submenu-inner">
                                <?php $no=1; $dataPemesanan = DB::table('data_pemesanan')->where('kode_pelanggan', Auth::user()->id)->get(); ?>
                                <table class="table table-bordered">
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama Produk</th>
                                        <th>Jumlah</th>
                                        <th>Ukuran</th>
                                        <th>Warna</th>
                                        <th>Tanggal Pesan</th>
                                        <th>Harga</th>
                                        <th>Kurir</th>
                                        <th>Total Harga</th>
                                        <th><center>Status</center></th>
                                    </tr>
                                    @foreach ($dataPemesanan as $dp)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ get_master_produk_id(base64_encode($dp->kode_produk))->nama_produk }}</td>
                                        <td>{{ $dp->jumlah }}</td>
                                        <td>{{ get_detail_produk_id($dp->id_detail_produk,'ukuran')->ukuran }}</td>
                                        <td>{{ get_detail_produk_id($dp->id_detail_produk,'warna')->nama_warna }}</td>
                                        <td>{{ tgl_indo(date(date('Y-m-d',strtotime($dp->tanggal_pesan)))) }}</td>
                                        <td>{{ number_format($dp->total_harga,2,'.',',') }}</td>
                                        <td>{{ $dp->kurir }} ({{ $dp->biaya_kirim }})</td>
                                        <td>{{ number_format($dp->sub_total,2,'.',',') }}</td>
                                        <td>
                                            <center>
                                            @if($dp->status_pemesanan == 0) {{-- Pesanan Baru --}}
                                                <span class="badge badge-warning">Pembayaran Diterima</span>
                                            @elseif($dp->status_pemesanan == 1) {{-- Proses Ditolak --}}
                                                <span class="badge badge-danger">Pesanan Ditolak</span>
                                            @elseif($dp->status_pemesanan == 2) {{-- Pesanan Terverifikasi --}}
                                                <span class="badge badge-success">Pesanan Sedang Disiapkan</span>
                                            @elseif($dp->status_pemesanan == 3) {{-- Proses Pengiriman --}}
                                                <span class="badge badge-primary">Proses Pengiriman</span>
                                            @elseif($dp->status_pemesanan == 4) {{-- Terkirim --}}
                                                <span class="badge badge-secondary">Telah Terkirim</span>
                                            @endif
                                            </center>
                                        </td>
                                    </tr>
                                    @endforeach
                                </table>
                            </div><!-- /mainmenu-submenu-inner -->
                        </div><!-- /mainmenu-submenu -->
                    </li>
                    <li class="pull-right">
                        <a href="{{route('cart')}}">Cart</a>
                    </li>
                    <li class="pull-right">
                        <a href="{{ route('logout') }}" class="menu-link" data-toggle="tooltip" data-placement="right" title="Logout">
                            <span class="menu-icon fa fa-logout text-primary"></span>
                            <span class="menu-text">{{ __('Logout') }}</span>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                @csrf
                            </form>
                        </a>
                    </li>
                    @else
                    <li class="pull-right">
                        <a href="{{ route('login') }}">Login</a>
                    </li>
                    @if (Route::has('register'))
                    <li class="pull-right">
                        <a href="{{ route('register') }}">Register</a>
                    </li>
                    @endif
                    @endauth
                    </li>
                    @endif
                </ul>
            </nav>
        </div>
    </div>


    <div class="section">
        <div class="container">
            @yield('content')
        </div>
    </div>


</body>
@yield('javascripts')
<script>
    function number_format(number, decimals, dec_point, thousands_sep) {
        // Strip all characters but numerical ones.
        number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
        var n = !isFinite(+number) ? 0 : +number,
            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
            sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
            dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
            s = '',
            toFixedFix = function(n, prec) {
                var k = Math.pow(10, prec);
                return '' + Math.round(n * k) / k;
            };
        // Fix for IE parseFloat(0.55).toFixed(0) = 0;
        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
        if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
        }
        if ((s[1] || '').length < prec) {
            s[1] = s[1] || '';
            s[1] += new Array(prec - s[1].length + 1).join('0');
        }
        return s.join(dec);
    }
</script>
@include('template.landing_page.foot.footer')
@include('template.landing_page.foot.footer_script')

</html>