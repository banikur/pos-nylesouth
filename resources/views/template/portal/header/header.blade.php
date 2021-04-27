<div id="kt_header" class="header header-fixed bg-white">
    <!--begin::Container-->
    <div class="container d-flex align-items-stretch justify-content-between">
        <!--begin::Left-->
        <div class="d-flex align-items-stretch mr-3">
            <!--begin::Header Logo-->
            <div class="header-logo">
                <a href="{{url('/')}}">
                    <img alt="Logo" src="{{url('images/logo-modi2.png')}}" class="logo-default max-h-40px" />
                    <img alt="Logo" src="{{url('images/logo-modi2.png')}}" class="logo-sticky max-h-40px" />
                </a>

            </div>
            <!--end::Header Logo-->
        </div>
        <!--end::Left-->
        <!--begin::Topbar-->
        <div class="topbar">
            <!--begin::Quick panel-->
            <div class="topbar-item" data-toggle="dropdown" data-offset="0px,0px">

            </div>

            <!--end::Quick panel-->
            <!--begin::User-->
            @if(Auth::check() == false)

            <div class="dropdown">
                <!--begin::Toggle-->
                <div class="topbar-item" data-offset="0px,0px">
                    <a href="{{route('list_perusahaan_page')}}" class="text-dark opacity-90 font-weight-bolder font-size-base d-none d-md-inline mr-4">DAFTAR PERUSAHAAN</a>
                    <a href="{{route('login')}}" class="text-dark opacity-90 font-weight-bolder font-size-base d-none d-md-inline mr-4">SELF SERVICE</a>
                    <a href="{{route('cas.callback')}}" class="text-dark opacity-90 font-weight-bolder font-size-base d-none d-md-inline mr-4">LOGIN INTERNAL</a>
                    <a href="{{route('dinas.index')}}" class="text-dark opacity-90 font-weight-bolder font-size-base d-none d-md-inline mr-4">LOGIN DINAS</a>
                </div>
                <!--end::Toggle-->
            </div>
            @else
            <div class="dropdown">
                <!--begin::Toggle-->
                <div class="topbar-item" data-offset="0px,0px">
                    <a href="{{route('list_perusahaan_page')}}" class="text-dark opacity-90 font-weight-bolder font-size-base d-none d-md-inline mr-4">DAFTAR PERUSAHAAN</a>
                    <a href="{{route('home')}}" class="text-dark opacity-90 font-weight-bolder font-size-base d-none d-md-inline mr-4">SELF SERVICE</a>
                    <a href="{{url('/logout')}}" class="text-dark opacity-90 font-weight-bolder font-size-base d-none d-md-inline mr-4">LOGOUT</a>
                </div>

                <!--end::Toggle-->
            </div>
            @endif
            <!--end::User-->
        </div>
        <!--end::Topbar-->
    </div>
    <!--end::Container-->
</div>