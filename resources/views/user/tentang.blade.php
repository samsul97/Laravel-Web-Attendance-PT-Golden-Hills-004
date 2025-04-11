@extends('user/master/master')

@section('title', 'Profil')

@section('active2', 'active')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12" style="margin-top:20px">
            <div class="card card-profile">
                <div class="card-avatar">
                    <img class="img" id="output" src="/img/logo.png" />
                </div>

                <div class="card-body">
                    <h6 class="card-category text-gray">Absen Dulu</h6>
                    <h4 class="card-title">Abdul</h4>
                    <p class="card-description">
                        Merupakan aplikasi absensi berbasis web dengan fitur geolocation dan webcam kamera.
                        <br>
                        Aplikasi ini dikembangkan oleh Divsite Teknologi.
                    </p>
                </div>
            </div>
          </div>
    </div>
</div>
@endsection

@section('script')

@endsection
