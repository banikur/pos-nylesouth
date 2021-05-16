@extends('template.perusahaan.main')

@section('title')

@endsection
@section('content')

<div class="card card-custom min-h-lg-500px">
    <div class="card-header">
        <div class="card-title">
            <h3 class="card-label">Selamat Datang di Aplikasi Point of Sale Toko {{ config('app.name', 'Laravel') }} </h3>
        </div>
        <div class="card-toolbar">
            <!-- <a href="{{ url('/logout') }}" class="btn btn-sm btn-danger font-weight-bolder"><i class="la la-close"></i>Keluar</a> -->
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12 ">

            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="row">

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('js')

@endsection