<!DOCTYPE html>

<html lang="en">
<!--begin::Head-->
<head>
@include('template.register_detail.header.head')
@include('template.register_detail.header.loader')
@yield('css')
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_body" style="background-image: url(images/bg/bg-1.png); height: 100%;background-repeat: no-repeat; background-size: cover;"
    class="quick-panel-right demo-panel-right offcanvas-right header-fixed subheader-enabled page-loading">
    <!--begin::Main-->
    <div class="loading" id="loader" style="">Loading&#8230;</div>
    <!--begin::Header Mobile-->
    @include('template.register_detail.header.header-mobile')
    <!--end::Header Mobile-->
    <div class="d-flex flex-column flex-root" style="">
        <!--begin::Page-->
        <div class="d-flex flex-row flex-column-fluid page">
            <!--begin::Wrapper-->
            <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
                <!--begin::Header-->
                @include('template.register_detail.header.header')
                <!--end::Header-->
                <!--begin::Content-->
                <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                    <!--begin::Subheader-->
                    @include('template.register_detail.header.subheader')
                    <!--end::Subheader-->

                    <!--begin::Entry-->

                    <div class="d-flex flex-column-fluid">
                        <!--begin::Container-->
                        <div class="container-fluid">
                            <div class="d-lg-flex flex-row-fluid">
                               
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
                @include('template.register_detail.footer.footer')
                <!--end::Footer-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Page-->
    </div>
    <!--end::Main-->
   
    @include('template.register_detail.panel.panel')
    @include('template.register_detail.footer.footer-script')
    @yield('js')
    

</body>
<!--end::Body-->


</html>
