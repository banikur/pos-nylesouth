@extends('template.landing_page.main')
@section('css')
@endsection
@section('content')
<div class="section">
    <div class="container" style="padding-bottom:147px;">
        <form id="profil" method="POST" action="{{route('post_profil')}}">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="nama">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="{{ ($user) ? $user->name : '' }}">
                </div>
                <div class="form-group col-md-6">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ ($user) ? $user->email : '' }}">
                </div>
                <div class="form-group col-md-6">
                    <label for="telpon">Telpon</label>
                    <input type="text" class="form-control" id="telpon" name="telpon" value="{{ ($user) ? $user->no_hp : '' }}">
                </div>
                <div class="form-group col-md-6">
                    <label for="alamat">Alamat</label>
                    <textarea rows="4" class="form-control" id="alamat" name="alamat">{{ ($user) ? $user->alamat : '' }}</textarea>
                </div>
            </div>
            <br>
            <button type="submit" class="btn btn-primary pull-right" style="margin-right:15px;">Update</button>
        </form>
    </div>
</div>
@endsection
@section('javascripts')
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
<script src="{{url('select2/js/select2.min.js')}}"></script>
<script src="{{url('js/bootstrap-number-input.js')}}"></script>

<script src='https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js'></script>
<script src="{{url('plugin/owl_carousel/script.js')}}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function refresh() {
        window.location.reload();
    }
    $(function() {
        @if(session('message'))
        Swal.fire({
            text: "{{session()->get('message')}}",
            icon: "success",
            buttonsStyling: false,
            confirmButtonText: "Ok, got it!",
            customClass: {
                confirmButton: "btn font-weight-bold btn-light"
            }
        });
        @endif
        @if(session('error'))
        Swal.fire({
            text: "{{session()->get('error')}}",
            icon: "error",
            buttonsStyling: false,
            confirmButtonText: "Ok, got it!",
            customClass: {
                confirmButton: "btn font-weight-bold btn-light"
            }
        });
        @endif
    });

</script>
@endsection
