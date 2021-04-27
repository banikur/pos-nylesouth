<div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">
    <!--begin::Menu Container-->
    <div id="kt_aside_menu" class="aside-menu min-h-lg-500px" data-menu-vertical="1" data-menu-scroll="1" data-menu-dropdown-timeout="500">
        <!--begin::Menu Nav-->
        <ul class="menu-nav">
            <li class="menu-item menu-item-submenu">
                <a id="menu-toggles" onclick="hideSidebar()" class="menu-link menu-toggle" data-toggle="tooltip" data-placement="right" title="Navigasi Menu">

                    <span class="menu-icon fas fa-align-justify">

                    </span>
                    <span class="menu-text"></span>
                </a>
            </li>
            <li class="menu-item" aria-haspopup="true">
                <a href="{{ url('/home') }}" class="menu-link" data-toggle="tooltip" data-placement="right" title="Dashboard">
                    <span class="menu-icon fa fa-home text-primary"></span>
                    <span class="menu-text">Beranda</span>
                </a>
            </li>

            <li class="menu-item" aria-haspopup="true">
                <a href="{{ route('master.provinsi') }}" class="menu-link" data-toggle="tooltip" data-placement="right" title="Dashboard">
                    <span class="menu-icon fa fa-home text-primary"></span>
                    <span class="menu-text">Provinsi & Kabupaten / Kota</span>
                </a>
            </li>

            <li class="menu-item" aria-haspopup="true">
                <a href="{{ route('master.pelanggan') }}" class="menu-link" data-toggle="tooltip" data-placement="right" title="Dashboard">
                    <span class="menu-icon fa fa-home text-primary"></span>
                    <span class="menu-text">Master Pelanggan </span>
                </a>
            </li>

            <li class="menu-item" aria-haspopup="true">
                <a href="{{ route('master.produk') }}" class="menu-link" data-toggle="tooltip" data-placement="right" title="Dashboard">
                    <span class="menu-icon fa fa-home text-primary"></span>
                    <span class="menu-text">Master Produk</span>
                </a>
            </li>

            <li class="menu-item" aria-haspopup="true">
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="menu-link" data-toggle="tooltip" data-placement="right" title="Logout">
                    <span class="menu-icon fa fa-logout text-primary"></span>
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
        $('#menu-toggles').attr('onClick', 'showSidebar()');
        $('.menu-nav .menu-text').css('display', 'none');
        $('.menu-nav .menu-arrow').css('display', 'none');

    }

    function showSidebar() {
        $('.aside').css('width', '260px');
        $('#menu-toggles').attr('onClick', 'hideSidebar()');
        $('.menu-nav .menu-text').css('display', 'block');
        $('.menu-nav .menu-arrow').css('display', 'block');
    }
</script>