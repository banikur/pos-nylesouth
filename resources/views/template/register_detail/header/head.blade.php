<meta charset="utf-8" />
<title>MODI</title>
<meta name="description" content="Layout options builder" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
<!--begin::Fonts-->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
<!--end::Fonts-->
<!--begin::Page Custom Styles(used by this page)-->
<link href="{{url('demo2/dist/assets/css/pages/wizard/wizard-2.css?v=7.0.6')}}" rel="stylesheet" type="text/css" />

<!-- Online Script -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
<!-- Online Script -->

<!--end::Page Custom Styles-->

<!--begin::Global Theme Styles(used by all pages)-->
<link href="{{url('demo2/dist/assets/plugins/global/plugins.bundlec3e8.css?v=7.0.6')}}" rel="stylesheet" type="text/css" />
<link href="{{url('demo2/dist/assets/plugins/custom/prismjs/prismjs.bundlec3e8.css?v=7.0.6')}}" rel="stylesheet" type="text/css" />
<link href="{{url('demo2/dist/assets/css/style.bundlec3e8.css?v=7.0.6')}}" rel="stylesheet" type="text/css" />
<!--end::Global Theme Styles-->
<!--begin::Layout Themes(used by all pages)-->
<!--end::Layout Themes-->
<link rel="shortcut icon" href="{{ url('images/logo.gif')}}" />



<script>
    (function(h, o, t, j, a, r) {
        h.hj = h.hj || function() {
            (h.hj.q = h.hj.q || []).push(arguments)
        };
        h._hjSettings = {
            hjid: 1070954,
            hjsv: 6
        };
        a = o.getElementsByTagName('head')[0];
        r = o.createElement('script');
        r.async = 1;
        r.src = t + h._hjSettings.hjid + j + h._hjSettings.hjsv;
        a.appendChild(r);
    })(window, document, 'https://static.hotjar.com/c/hotjar-', '.js?sv=');
</script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async="async" src="https://www.googletagmanager.com/gtag/js?id=UA-37564768-1"></script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());
    gtag('config', 'UA-37564768-1');

    window.addEventListener('load', function() {
        $('#loader').fadeOut(1000);
    }, true);
</script>
<style>
    @media (min-width: 992px) {
        .content-wrapper {
            margin-left: 20px;
        }
    }

    @media (min-width: 992px) {
        .aside-enabled .content .content-wrapper {
            padding-left: 25px;
        }
    }

    .aside-menu .menu-nav .menu-inner,
    .aside-menu .menu-nav .menu-submenu {
        margin-left: -15px;
    }

    @media (min-width: 992px) {
        .header-menu-wrapper.header-menu-wrapper-left {
            display: none;
        }
    }

    @media (min-width: 992px) {
        .header-fixed[data-header-scroll="on"] .header {
            /* background-image: url("{{ url('/images/bg-subheader.png')}}"); */

        }

        body[data-header-scroll="on"] .topbar .btn.btn-icon .text-white {
            color: #09090b !important;
        }

    }
</style>