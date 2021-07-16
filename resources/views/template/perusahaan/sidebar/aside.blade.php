<div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">
    <!--begin::Menu Container-->
    <div id="kt_aside_menu" class="aside-menu min-h-lg-500px" data-menu-vertical="1" data-menu-scroll="1" data-menu-dropdown-timeout="500">
        <!--begin::Menu Nav-->
        <ul class="menu-nav">
            <li class="menu-item menu-item-submenu">
                <a id="menu-toggle" onclick="hideSidebar()" class="menu-link menu-toggle" data-toggle="tooltip" data-placement="right" title="Menu">

                    <span class="menu-icon fas fa-align-justify">

                    </span>
                    <span class="menu-text">Menu</span>
                </a>
            </li>
            <li class="menu-item" aria-haspopup="true">
                <a href="{{ url('/home') }}" class="menu-link" data-toggle="tooltip" data-placement="right" title="Dashboard">
                    <span class="menu-icon fa fa-home text-primary"></span>
                    <span class="menu-text">Beranda</span>
                </a>
            </li>
            <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                <a href="javascript:;" class="menu-link menu-toggle" data-toggle="tooltip" data-placement="right" title="">
                    <span class="menu-icon fas fa-archive text-primary">

                    </span>
                    <span class="menu-text text-dark">Master</span>
                    <i class="menu-arrow text-dark"></i>
                </a>
                <div class="menu-submenu">
                    <i class="menu-arrow text-dark"></i>
                    <ul class="menu-subnav">
                        <li class="menu-item" aria-haspopup="true">
                            <a href="{{ route('master.provinsi') }}" class="menu-link" data-toggle="tooltip" data-placement="right" title="Master Provinsi">
                                <span class="menu-icon fas fa-map-marker-alt text-primary"></span>
                                <span class="menu-text">Provinsi & Kabupaten / Kota</span>
                            </a>
                        </li>

                        <li class="menu-item" aria-haspopup="true">
                            <a href="{{ route('master.pelanggan') }}" class="menu-link" data-toggle="tooltip" data-placement="right" title="Master Pelanggan">
                                <span class="menu-icon fas fa-users-cog text-primary"></span>
                                <span class="menu-text">Master Pelanggan </span>
                            </a>
                        </li>

                        <li class="menu-item" aria-haspopup="true">
                            <a href="{{ route('master.produk') }}" class="menu-link" data-toggle="tooltip" data-placement="right" title="Master Produk">
                                <span class="menu-icon fas fa-tags text-primary"></span>
                                <span class="menu-text">Master Produk</span>
                            </a>
                        </li>

                        <li class="menu-item" aria-haspopup="true">
                            <a href="{{ route('master.promo') }}" class="menu-link" data-toggle="tooltip" data-placement="right" title="Master Promo">
                                <span class="menu-icon fa fa-percent text-primary"></span>
                                <span class="menu-text">Master Promo</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                <a href="javascript:;" class="menu-link menu-toggle" data-toggle="tooltip" data-placement="right" title="">
                    <span class="menu-icon fas fa-tasks text-primary">
                    </span>
                    <span class="menu-text text-dark">Verifikasi Penjualan</span>
                    <i class="menu-arrow text-dark"></i>
                </a>
                <div class="menu-submenu">
                    <i class="menu-arrow text-dark"></i>
                    <ul class="menu-subnav">
                        <li class="menu-item" aria-haspopup="true">
                            <a href="{{ route('init.pemesanan') }}" class="menu-link" data-toggle="tooltip" data-placement="right" title="Verifikasi Penjualan">
                                <span class="menu-icon fas fa-cart-plus text-primary"></span>
                                <span class="menu-text text-dark">Daftar Pesanan</span>
                            </a>
                        </li>
                        <li class="menu-item" aria-haspopup="true">
                            <a href="{{ route('init.retur') }}" class="menu-link" data-toggle="tooltip" data-placement="right" title="Verifikasi Retur Barang">
                                <span class="menu-icon fas fa-cart-arrow-down text-primary"></span>
                                <span class="menu-text text-dark">Verifikasi Retur barang </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="menu-item" aria-haspopup="true">
                <a href="#" class="menu-link" data-toggle="tooltip" data-placement="right" title="Laporan">
                    <span class="menu-icon far fa-file-alt text-primary"></span>
                    <span class="menu-text">Laporan</span>
                </a>
            </li>

            <li class="menu-item" aria-haspopup="true">
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="menu-link" data-toggle="tooltip" data-placement="right" title="Logout">
                    <span class="menu-icon fas fa-power-off text-primary"></span>
                    <span class="menu-text">{{ __('Logout') }}</span>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </a>
            </li>
        </ul>
        <!--end::Menu Nav-->
    </div>
    <!--end::Menu Container-->
</div>

<script>
    function hideSidebar() {
        $('.aside').css('width', '60px');
        $('#menu-toggle').attr('onClick', 'showSidebar()');
        $('.menu-nav .menu-text').css('display', 'none');
        $('.menu-nav .menu-arrow').css('display', 'none');
    }
    function showSidebar() {
        $('.aside').css('width', '260px');
        $('#menu-toggle').attr('onClick', 'hideSidebar()');
        $('.menu-nav .menu-text').removeAttr('style', 'display');
        $('.menu-nav .menu-arrow').removeAttr('style', 'display');
    }
</script>