<!DOCTYPE html>

<html lang="en">
<!--begin::Head-->

<head>
    @include('template.perusahaan.header.head')
    @include('template.perusahaan.header.loader')
    @yield('css')
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_body" class="quick-panel-right demo-panel-right offcanvas-right header-fixed subheader-enabled page-loading">
    <!--begin::Main-->
    <div class="loading" id="loader" style="">Loading&#8230;</div>
    <!--begin::Header Mobile-->
    @include('template.perusahaan.header.header-mobile')
    <!--end::Header Mobile style="background-image: url('{{ url('images/bg.png')}}')"-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Page-->
        <div class="d-flex flex-row flex-column-fluid page" style="background: url({{ asset('images/bg/bg-1.png') }}); height: 100%; background-repeat: no-repeat; background-size: cover;">
            <!--begin::Wrapper-->
            <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
                <!--begin::Header-->
                @include('template.perusahaan.header.header')
                <!--end::Header-->
                <!--begin::Content-->
                <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                    <!--begin::Subheader-->
                    <div class="subheader py-2 py-lg-12 subheader-transparent" id="kt_subheader">
                    </div>

                    <!--end::Subheader-->

                    <!--begin::Entry-->
                    <div class="d-flex flex-column-fluid">
                        <!--begin::Container-->
                        <div class="container-fluid">
                            <div class="d-lg-flex flex-row-fluid">
                                <!--begin::Aside-->
                               
                                <div class="aside aside-left d-flex flex-column flex-row-auto" id="kt_aside">
                                    <!--begin::Aside Menu-->
                                    @include('template.perusahaan.sidebar.aside')
                                    <!--end::Aside Menu-->
                                </div>
                               
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
                @include('template.perusahaan.footer.footer')
                <!--end::Footer-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Page-->
    </div>
    <!--end::Main-->

    @include('template.perusahaan.panel.panel')
    @include('template.perusahaan.footer.footer-script')
    @yield('js')

    <script>
        function markAsRead(obj)
        {
            var item = $(obj).data('item');
        }
    </script>
</body>
<!--end::Body-->


</html>