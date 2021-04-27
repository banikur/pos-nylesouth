<!DOCTYPE html>

<html lang="en">
<!--begin::Head-->

<head>
    @include('template.portal.header.head')
    @include('template.portal.header.loader')
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_body" class="quick-panel-right demo-panel-right offcanvas-right header-fixed subheader-enabled page-loading">
    <!--begin::Main-->
    <div class="loading" id="loader" style="">Loading&#8230;</div>
    <!--begin::Header Mobile-->
    @include('template.portal.header.header-mobile')
    <!--end::Header Mobile style="background-image: url('{{ url('images/bg.png')}}')"-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Page-->
        <div class="d-flex flex-row flex-column-fluid page" style="background-color:#f2f3f5; height: 100%; background-repeat: no-repeat; background-size: cover;">
            <!--begin::Wrapper-->
            <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
                <!--begin::Header-->
                @include('template.portal.header.header')
                <!--end::Header-->
                <!--begin::Content-->
                <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                    <!--begin::Subheader-->
                    <!-- <div class="subheader py-2 py-lg-12 subheader-transparent" id="kt_subheader">
                    </div> -->
                
                    <!--end::Subheader-->

                    <!--begin::Entry-->
                    <div class="d-flex flex-column-fluid mt-8">
                        <!--begin::Container-->
                        <div class="container-fluid">
                            <div class="d-lg-flex flex-row-fluid">
                                <!--begin::Aside-->
                                @if(!empty(Auth::user()->kode_wiup))
                                <div class="aside aside-left d-flex flex-column flex-row-auto" id="kt_aside">
                                    <!--begin::Aside Menu-->
                                    @include('template.perusahaan.sidebar.aside')
                                    <!--end::Aside Menu-->
                                </div>
                                @else

                                @endif
                                <!--end::Aside-->
                                <div class="content-wrapper flex-row-fluid">
                                    <!--begin::Content-->
                                    @yield('content')
                                    <!--end::Content-->

                                </div>
                            </div>
                        </div>
                        <!--end::Container-->
                    </div>

                    <!--end::Entry-->
                </div>
                <!--end::Content-->
                <!--begin::Footer-->
                @include('template.portal.footer.footer')
                <!--end::Footer-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Page-->
    </div>
    <!--end::Main-->

    @include('template.portal.panel.panel')
    @include('template.portal.footer.footer-script')
    @yield('js')


</body>
<!--end::Body-->


</html>