<div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">
    <!--begin::Menu Container-->
    <div id="kt_aside_menu" class="aside-menu min-h-lg-500px" data-menu-vertical="1" data-menu-scroll="1" data-menu-dropdown-timeout="500">
        <!--begin::Menu Nav-->
        <ul class="menu-nav">
            <li class="menu-item menu-item-submenu">
                <a id="menu-toggles" onclick="hideSidebar()" class="menu-link menu-toggle" data-toggle="tooltip" data-placement="right" title="Navigasi Menu">

                    <span class="menu-icon fas fa-align-justify">

                    </span>
                    <span class="menu-text"><b>{{get_perusahaan(Auth::user()->id_perusahaan)}}</b></span>
                </a>
            </li>
            <li class="menu-item" aria-haspopup="true">
                <a href="{{ url('/home') }}" class="menu-link" data-toggle="tooltip" data-placement="right" title="Dashboard">
                    <span class="menu-icon fa fa-home text-primary">
                    </span>
                    <span class="menu-text">Beranda</span>
                </a>
            </li>
            @if(count(verify_user_direksi(Auth::user()->id_perusahaan)) > 0)
            <li class="menu-item" aria-haspopup="true">
                <a href="{{ route('perusahaan.direksi_page') }}" class="menu-link" data-toggle="tooltip" data-placement="right" title="Susunan Pengurus Perusahaan">
                    <span class="menu-icon fas fa-chalkboard-teacher text-primary">
                    </span>
                    <span class="menu-text">Susunan Pengurus Perusahaan</span>
                </a>
            </li>
            @else
            <li class="menu-item" aria-haspopup="true">
                <a href="{{ route('perusahaan.direksi_page') }}" class="menu-link" data-toggle="tooltip" data-placement="right" title="Susunan Pengurus Perusahaan">
                    <span class="menu-icon fas fa-chalkboard-teacher text-primary">
                    </span>
                    <span class="menu-text">Susunan Pengurus Perusahaan</span>
                </a>
            </li>
            @endif
            @if(count(verify_user_saham(Auth::user()->id_perusahaan)) > 0)
            <li class="menu-item" aria-haspopup="true">
                <a href="{{ route('perusahaan.saham_page') }}" class="menu-link" data-toggle="tooltip" data-placement="right" title="Pemilik Saham Perusahaan">
                    <span class="menu-icon fas fa-hand-holding-usd text-primary">
                    </span>
                    <span class="menu-text">Pemilik Saham Perusahaan</span>
                </a>
            </li>
            @else
            <li class="menu-item" aria-haspopup="true">
                <a href="{{ route('perusahaan.saham_page') }}" class="menu-link" data-toggle="tooltip" data-placement="right" title="Pemilik Saham Perusahaan">
                    <span class="menu-icon fas fa-hand-holding-usd text-primary">
                    </span>
                    <span class="menu-text">Pemilik Saham Perusahaan</span>
                </a>
            </li>
            @endif
            <li class="menu-item" aria-haspopup="true">
                <a href="{{  route('perusahaan.dokumen_page')}}" class="menu-link" data-toggle="tooltip" data-placement="right" title="Dokumen Pelengkap">
                    <span class="menu-icon fas fa-file-upload text-primary">
                    </span>
                    <span class="menu-text">Dokumen Pelengkap Perusahaan</span>
                </a>
            </li>
            @if(count(verify_user_perizinan(Auth::user()->id_perusahaan)) > 0)
            <li class="menu-item" aria-haspopup="true">
                <a href="{{  route('perusahaan.izin_page')}}" class="menu-link" data-toggle="tooltip" data-placement="right" title="Perizinan Perusahaan">
                    <span class="menu-icon fas fa-handshake text-primary">
                    </span>
                    <span class="menu-text">Perizinan Perusahaan</span>
                </a>
            </li>
            @else
            <li class="menu-item" aria-haspopup="true">
                <a href="{{  route('perusahaan.izin_page')}}" class="menu-link" data-toggle="tooltip" data-placement="right" title="Perizinan Perusahaan">
                    <span class="menu-icon fas fa-handshake text-primary">
                    </span>
                    <span class="menu-text">Perizinan Perusahaan</span>
                </a>
            </li>
            @endif

            <li class="menu-item" aria-haspopup="true">
                <a href="{{  route('perusahaan.pengajuan_page')}}" class="menu-link" data-toggle="tooltip" data-placement="right" title="Kirim Pengajuan Perusahaan">
                    <span class="menu-icon fas fa-paper-plane text-primary">
                    </span>
                    <span class="menu-text">Kirim Pengajuan</span>
                </a>
            </li>
            <li class="menu-item" aria-haspopup="true">
                <a href="{{ url('/logout') }}" class="menu-link" data-toggle="tooltip" data-placement="right" title="Logout">
                    <span class="menu-icon fa fa-sign-out-alt text-primary">
                    </span>
                    <span class="menu-text">Logout</span>
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