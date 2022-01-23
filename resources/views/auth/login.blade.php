<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="shortcut icon" href="{{asset('assets/logo.gif')}}" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('front_login/vendor/bootstrap/css/bootstrap.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('front_login/fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('front_login/fonts/Linearicons-Free-v1.0.0/icon-font.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('front_login/vendor/animate/animate.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('front_login/vendor/css-hamburgers/hamburgers.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('front_login/vendor/animsition/css/animsition.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('front_login/vendor/select2/select2.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('front_login/vendor/daterangepicker/daterangepicker.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('front_login/css/util.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('front_login/css/main.css')}}">

    <script src="{{asset('/js/sweetalert2/dist/sweetalert2.all.min.js')}}"></script>
    <script src="{{asset('/js/sweetalert2/dist/sweetalert2.min.js')}}"></script>
    <link rel="stylesheet" href="{{asset('/js/sweetalert2/dist/sweetalert2.min.css')}}">

    <style>
        body,
        html {
            height: 100%;
            margin: 0;
        }

        .bg {
            /* The image used "*/
            background-image: url("{{asset('assets/bg.jpg')}}");
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;

            /* Full height */
            height: 100%;

            /* Center and scale the image nicely */
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>
    <!--===============================================================================================-->
</head>

<body>

    <div class="bg">
        <div class="limiter">
            <div class="wrap-login100 p-l-55 p-r-55 p-t-45 p-b-30" style="float: right; margin: 5%">
                <form class="login100-form validate-form" id="login-user-perusahaan-form" method="POST" action="{{ route('login') }}">
                    @csrf
                    <span class="login100-form-title p-b-33">
                        <h4>Nyle-South Distro</h4>
                        <hr />
                        <a href="{{route('register')}}">
                            <p style="color: #4272d7;">Belum Memiliki Akun ? Daftar Disini ! </p>
                        </a>
                    </span>
                    <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
                        <input required class="input100" type="text" name="email" style="text-transform:lowercase;height: 40px;" placeholder="E-mail">
                        <input type="hidden" name="ip" id="ip" />
                        <input type="hidden" name="city" id="city" />
                        <input type="hidden" name="district" id="district" />
                    </div>
                    <br>
                    <div class="wrap-input100 validate-input" data-validate="Password is required">
                        <input required class="input100" type="password" name="password" placeholder="Kata Sandi" style="height: 40px">
                    </div>
                    <span class="pull-right"><small><a href="{{route('password.request')}}">Lupa Kata Sandi ? </a></small></span>
                    <br /><br />
                    <div class="contact100-form-checkbox">
                        <div class="col-md-12">
                            <center>
                                <div id="captcha-perusahaan"></div>
                            </center>
                        </div>
                    </div>
                    <br />
                    @if($errors->any())
                    <br>
                    <div style="text-align: center">
                        <span style="font-weight: bold; color: red">User tidak terdaftar <a href=""></a></span>
                    </div>
                    @endif
                    <div class="container-login100-form-btn m-t-20">
                        <div class="col-md-12">
                            <button type="button" onclick="verifyCaptchaPerusahaan(grecaptcha.getResponse(widget))" class="login100-form-btn btn-block">
                                <strong>Masuk</strong>
                            </button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--===============================================================================================-->
    <script src="{{asset('front_login/vendor/jquery/jquery-3.2.1.min.js')}}"></script>
    <!--===============================================================================================-->
    <script src="{{asset('front_login/vendor/animsition/js/animsition.min.js')}}"></script>
    <!--===============================================================================================-->
    <script src="{{asset('front_login/vendor/bootstrap/js/popper.js')}}"></script>
    <script src="{{asset('front_login/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
    <!--===============================================================================================-->
    <script src="{{asset('front_login/vendor/select2/select2.min.js')}}"></script>
    <!--===============================================================================================-->
    <script src="{{asset('front_login/vendor/daterangepicker/moment.min.js')}}"></script>
    <script src="{{asset('front_login/vendor/daterangepicker/daterangepicker.js')}}"></script>
    <!--===============================================================================================-->
    <script src="{{asset('front_login/vendor/countdowntime/countdowntime.js')}}"></script>
    <!--===============================================================================================-->
    <script src="front_login/js/main.js"></script>
    <script type="text/javascript">
        $.getJSON('https://json.geoiplookup.io/', function(data) {
            var json = data;
            console.log(data);
            var ip = json.ip;
            $('#ip').val(json.ip);
            $('#city').val(json.city);
            $('#district').val(json.district);
        });
        var verifyCallback = function(response) {
            alert(response);
        }
        var widget;
        var widget2;
        var widget3;
        var onloadCallback = function() {
            widget =
                grecaptcha.render('captcha-perusahaan', {
                    'sitekey': "{{ config('app.site_key_recaptcha') }}",
                    'theme': 'light'
                });
        }

        function verifyCaptchaPerusahaan(result) {
            // console.log(result);
            if (result !== "") {
                console.log("submit");
                $('#login-user-perusahaan-form').submit();
            } else {
                Swal.fire({
                    icon: 'error',
                    text: 'Harap isi Captcha',
                    showConfirmButton: true,
                });
            }
        }
    </script>
    <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>
    @if(Session::has('success'))
    <script type="text/javascript">
        // swal('Berhasil', '{{Session::get("success")}}', 'success');
        Swal.fire({
            text: "{{Session::get('success')}}",
            icon: "success",
            buttonsStyling: false,
            confirmButtonText: "Ok",
            customClass: {
                confirmButton: "btn font-weight-bold btn-light"
            }
        });
    </script>
    <?php
    Session::forget('success');
    ?>
    @endif
    @if(Session::has('error'))
    <script type="text/javascript">
        // swal('Gagal', '{{Session::get("error")}}', 'error');
        Swal.fire({
            text: "{{Session::get('error')}}",
            icon: "error",
            buttonsStyling: false,
            confirmButtonText: "Ok",
            customClass: {
                confirmButton: "btn font-weight-bold btn-light"
            }
        });
    </script>
    <?php
    Session::forget('error');
    ?>
    @endif
</body>

</html>