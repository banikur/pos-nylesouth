<!--begin::Global Config(global config for global JS scripts)-->
<script>
    var KTAppSettings = {
        "breakpoints": {
            "sm": 576,
            "md": 768,
            "lg": 992,
            "xl": 1200,
            "xxl": 1200
        },
        "colors": {
            "theme": {
                "base": {
                    "white": "#ffffff",
                    "primary": "#6993FF",
                    "secondary": "#E5EAEE",
                    "success": "#1BC5BD",
                    "info": "#8950FC",
                    "warning": "#FFA800",
                    "danger": "#F64E60",
                    "light": "#F3F6F9",
                    "dark": "#212121"
                },
                "light": {
                    "white": "#ffffff",
                    "primary": "#E1E9FF",
                    "secondary": "#ECF0F3",
                    "success": "#C9F7F5",
                    "info": "#EEE5FF",
                    "warning": "#FFF4DE",
                    "danger": "#FFE2E5",
                    "light": "#F3F6F9",
                    "dark": "#D6D6E0"
                },
                "inverse": {
                    "white": "#ffffff",
                    "primary": "#ffffff",
                    "secondary": "#212121",
                    "success": "#ffffff",
                    "info": "#ffffff",
                    "warning": "#ffffff",
                    "danger": "#ffffff",
                    "light": "#464E5F",
                    "dark": "#ffffff"
                }
            },
            "gray": {
                "gray-100": "#F3F6F9",
                "gray-200": "#ECF0F3",
                "gray-300": "#E5EAEE",
                "gray-400": "#D6D6E0",
                "gray-500": "#B5B5C3",
                "gray-600": "#80808F",
                "gray-700": "#464E5F",
                "gray-800": "#1B283F",
                "gray-900": "#212121"
            }
        },
        "font-family": "Poppins"
    };
</script>
<!--end::Global Config-->
<!--begin::Global Theme Bundle(used by all pages)-->
<script src="{{url('demo2/dist/assets/plugins/global/plugins.bundlec3e8.js?v=7.0.6')}}"></script>
<script src="{{url('demo2/dist/assets/plugins/custom/prismjs/prismjs.bundlec3e8.js?v=7.0.6')}}"></script>
<script src="{{url('demo2/dist/assets/js/scripts.bundlec3e8.js?v=7.0.6')}}"></script>
<script src="{{url('/js/jquery-validate/jquery.form-validator.min.js')}}"></script>
<!--end::Global Theme Bundle-->
<!--begin::Page Scripts(used by this page)-->
<script src="{{url('demo2/dist/assets/js/pages/builderc3e8.js?v=7.0.6')}}"></script>
<!--end::Page Scripts-->
<!--begin::Page Scripts(used by this page)-->
<!-- <script src="{{url('demo2/src/js/pages/crud/file-upload/dropzonejs.js?v=7.0.6')}}"></script> -->
<script src="{{url('demo2/src/js/pages/crud/forms/widgets/bootstrap-datepicker.js?v=7.0.6')}}"></script>
<script src="{{url('demo2/src/js/pages/crud/forms/widgets/input-mask.js?v=7.0.6')}}"></script>

{{-- Input Mask By Daniel D Fortuna --}}
<script src="{{ url('js/inputmask/jquery.inputmask.bundle.min.js') }}" charset="utf-8"></script>

<!-- DataTables -->
<script src="{{url('demo2/dist/assets/plugins/custom/datatables/datatables.bundlec3e8.js?v=7.0.6')}}"></script>
<link href="{{url('demo2/dist/assets/plugins/custom/datatables/datatables.bundlec3e8.css?v=7.0.6')}}" rel="stylesheet" type="text/css" />
<!-- <script src="{{asset('plugin/draw/src/excel/xlsx.full.min.js')}}"></script> -->

<!-- <script src="{{asset('plugin/draw/Draw.Control.js')}}"></script> -->
<!-- <script src="{{asset('plugin/draw/CustomDraw.js')}}"></script> -->

{{-- Date Picker --}}
<link rel="stylesheet" href="{{url('flatpickr/flatpickr.min.css')}}">
<script src="{{url('flatpickr/flatpickr.js')}}"></script>


<!-- Online Script -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script> -->
<!-- Online Script -->
<script>
    const numberFormat = (value, decimals, decPoint, thousandsSep) => {
        decPoint = decPoint || '.';
        decimals = decimals !== undefined ? decimals : 2;
        thousandsSep = thousandsSep || ' ';

        if (typeof value === 'string') {
            value = parseFloat(value);
        }

        let result = value.toLocaleString('en-US', {
            maximumFractionDigits: decimals,
            minimumFractionDigits: decimals
        });

        let pieces = result.split('.');
        pieces[0] = pieces[0].split(',').join(thousandsSep);

        return pieces.join(decPoint);
    };
</script>
<!--end::Page Scripts-->