<div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">
    <!--begin::Menu Container-->
    <div id="kt_aside_menu" class="aside-menu min-h-lg-800px" data-menu-vertical="1" data-menu-scroll="1" data-menu-dropdown-timeout="500">
        <!--begin::Menu Nav-->
        @if(Auth::check())
        <ul class="menu-nav">
            <li class="menu-item menu-item-submenu">
                <a id="menu-toggles" onclick="hideSidebar()" class="menu-link menu-toggle" data-toggle="tooltip" data-placement="right" title="Navigasi Menu">

                    <span class="menu-icon fas fa-align-justify">

                    </span>
                    <span class="menu-text">Navigasi Menu</span>
                </a>
            </li>
            <li class="menu-item" aria-haspopup="true">
                <a href="{{ url('/') }}" class="menu-link" data-toggle="tooltip" data-placement="right" title="Dashboard">
                    <span class="menu-icon fa fa-home text-success">

                    </span>
                    <span class="menu-text">Dashboard</span>
                </a>
            </li>

            @php $menu = menu(); $submenu = menu(); @endphp
            @foreach($menu as $men)
            @if($men->parent_id == NULL)
            @if($men->url != NULL)
            <li class="menu-item" aria-haspopup="true">
                <a href="{{url($men->url)}}" class="menu-link" data-toggle="tooltip" data-placement="right" title="{{$men->name}}">
                    <span class="menu-icon fa {{$men->icon}} text-success">

                    </span>
                    <span class="menu-text">{{$men->name}}</span>
                </a>
            </li>
            @else
            <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                <a href="javascript:;" class="menu-link menu-toggle" data-toggle="tooltip" data-placement="right" title="{{$men->name}}">
                    <span class="menu-icon fa {{$men->icon}} text-success">

                    </span>
                    <span class="menu-text">{{$men->name}}</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="menu-submenu">
                    <i class="menu-arrow"></i>
                    <ul class="menu-subnav">
                        @foreach($submenu as $sub)
                        @if($sub->parent_id != NULL && $sub->parent_id == $men->id)
                        <li class="menu-item" aria-haspopup="true">
                            @php $url_sub=($sub->url)?$sub->url:'#';@endphp
                            <a href="{{ url($url_sub)}}" class="menu-link" data-toggle="tooltip" data-placement="right" title="{{ $sub->name }}">
                                <span class="menu-icon fa {{$sub->icon}} text-success">

                                </span>
                                <span class="menu-text">{{$sub->name}}</span>
                            </a>
                        </li>
                        @endif

                        @endforeach
                    </ul>
                </div>
            </li>
            @endif
            @endif
            @endforeach

        </ul>
        @else
        @endif
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