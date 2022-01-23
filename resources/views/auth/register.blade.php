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
            /* The image used */
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
            <div class="container-login100">
                <div class="wrap-login200 p-l-55 p-r-55 p-t-45 p-b-30" style="float: right; margin: 5%;">
                    <span class="login100-form-title ">
                        <h4>Daftar Sebagai Pelanggan Nyle-South Distro</h4>
                        <hr />
                    </span>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-left">{{ __('Name') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="input100 @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-left">{{ __('E-Mail Address') }}</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="input100 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="no_telp" class="col-md-4 col-form-label text-md-left">{{ __('No Telp') }}</label>
                            <div class="col-md-6">
                                <input id="no_telp" type="text" class="input100 @error('no_telp') is-invalid @enderror" name="no_telp" value="{{ old('no_telp') }}" required autocomplete="name" autofocus>
                                @error('no_telp')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-left">{{ __('Alamat') }}</label>
                            <div class="col-md-6">
                                <textarea class="input100 @error('alamat') is-invalid @enderror" id="alamat" name="alamat" placeholder="" value="{{ old('alamat') }}"></textarea>
                                @error('alamat')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-left">{{ __('Password') }}</label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="input100 @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-left">{{ __('Confirm Password') }}</label>
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="input100" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                        <br />
                        <div class="container-login100-form-btn m-t-20">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary btn-block">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
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

    <script src="{{asset('front_login/js/main.js')}}"></script>
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