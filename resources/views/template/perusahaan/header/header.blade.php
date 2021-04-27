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

            <!--end::Quick panel-->
            <!--begin::User-->
            @if(Auth::check() == null)
            <div class="dropdown">
                <!--begin::Toggle-->
                <div class="topbar-item" data-offset="0px,0px">
                    <a href="{{route('login')}}" class="text-dark opacity-90 font-weight-bolder font-size-base d-none d-md-inline mr-4">Login</a>
                </div>
                <!--end::Toggle-->
            </div>
            @else
            <div class="topbar-item" data-offset="0px,0px">
                <!-- <a href="{{url('/')}}" class="text-dark opacity-90 font-weight-bolder font-size-base d-none d-md-inline mr-4">DASHBOARD</a> -->
            </div>
            @endif
            <div class="topbar-item" data-toggle="dropdown" data-offset="0px,0px">
                <div class="btn btn-icon btn-hover-transparent-white d-flex align-items-center btn-lg px-md-2 w-md-auto" id="kt_quick_panel_toggle">
                    <span class="svg-icon svg-icon-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24" />
                                <rect fill="#000000" x="4" y="4" width="7" height="7" rx="1.5" />
                                <path d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z" fill="#000000" opacity="0.3" />
                            </g>
                        </svg>
                    </span>
                   
                    <span class="badge badge-danger badge-pill badge-sm font-weight-bold">0</span>
                </div>
            </div>
            <!--end::User-->
        </div>
        <!--end::Topbar-->
    </div>
    <!--end::Container-->
</div>