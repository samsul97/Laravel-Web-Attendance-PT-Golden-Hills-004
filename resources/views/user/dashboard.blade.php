@extends('user/master/master')

@section('title', 'Dashboard')

@section('active1', 'active')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
          <div class="card card-profile">
            <div class="card-header card-header-danger">
                <img style="background: white; padding:10px; border-radius:25px" src="/img/logo_long.png" width="90px">
                <p>
                    <h4 id="date-part"></h4>
                    <h5 id="time-part"></h5>
                </p>
            </div>
            <div class="card-body">
                <br>
                <center><h4 class="card-title"><b>Hai</b>, {{$nama}}</h4></center>
                <br>
                @if($cuti_state)
                    <div class="alert alert-info">
                        <span>
                            <b> Info - </b> Anda sedang mengambil cuti, silahkan melakukan absensi kembali nanti!
                        </span>
                    </div>
                @else
                    <a href="/user/absensi/IN" id="masuk"
                        @if($masuk_state < 1)
                            class="btn btn-info btn-lg" style="color: azure;"
                        @else
                            class="btn btn-secondary btn-lg" style="cursor: not-allowed";
                            hidden
                        @endif
                    >MASUK</a>

                    <a href="/user/absensi/OUT" id="pulang"
                        @if($masuk_state > 0 && $pulang_state < 1)
                            class="btn btn-info btn-lg" style="color: azure;"
                        @else
                            class="btn btn-secondary btn-lg" style="cursor: not-allowed;"
                            hidden
                        @endif
                    >PULANG</a>
                @endif
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-12">
            <div class="card card-stats">
              <div class="card-header card-header-warning">
                <div class="card-icon">
                    <i class="material-icons" data-notify="icon">note</i>
                </div>
                <h5 class="card-title">Catatan Hari Ini</h5>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                    @if($absensi->count()>0)
                    <table class="table table-hover">
                        {{-- <thead>
                            <tr>
                                <td class="text-left"><b>Tanggal</b></td>
                                <td class="text-left"><b>Waktu</b></td>
                                <td class="text-center"><b>Keterangan</b></td>
                            </tr>
                        </thead> --}}
                        <tbody>
                            @for($i=0; $i<count($absensi); $i++)
                            @if($i <= 2)
                            <tr>
                                <td class="text-left">
                                    {{\Carbon\Carbon::parse($absensi[$i]->tgl)->format('d/m/Y')}}
                                </td>
                                <td class="text-left">
                                    {{\Carbon\Carbon::parse($absensi[$i]->waktu)->format('H.i')}}
                                </td>
                                <td class="text-center">
                                    {{$absensi[$i]->in_out}}
                                </td>
                            </tr>
                            @endif
                            @endfor
                        </tbody>
                    </table>
                    <i class="material-icons text-info">cached</i>
                    <a href="/user/catatanKehadiran">Selengkapnya....</a>
                    @else
                    <br>
                    <center>
                        <h6>Belum ada data!</h6>
                    </center>
                    @endif
                </div>
              </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-12">
            <div class="card">
              <div class="card-header card-header-success card-header-icon">
                <div class="card-icon">
                    <i class="material-icons" data-notify="icon">done_outline</i>
                </div>
                <h5 class="card-title"> Masuk Hari Ini</h5>
              </div>
              <div class="card-body">
                @if($hadir->count()>0)
                <div class="masuk">
                    @foreach($hadir as $key => $hdr)
                    <div>
                        <table>
                            <tr>
                                <td>
                                    @if($hdr->foto == null)
                                    <a href="">
                                        <img width="70px" height="70px" style="border-radius: 50%" src="/img/user.png" />
                                    </a>
                                    @else
                                    <a href="{{\Illuminate\Support\Facades\Storage::url($hdr->foto)}}" target="_blank">
                                        <img width="70px" height="70px" style="border-radius: 50%" src="{{\Illuminate\Support\Facades\Storage::url($hdr->foto)}}" />
                                    </a>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    <small>{{$hdr->karyawan->nama}}</small>
                                </td>
                            </tr>
                        </table>
                    </div>
                    @endforeach
                </div>
                @else
                <br>
                <center>
                    <h6>Belum ada data!</h6>
                </center>
                @endif
              </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-12">
            <div class="card">
              <div class="card-header card-header-danger card-header-icon">
                <div class="card-icon">
                    <i class="material-icons" data-notify="icon">subdirectory_arrow_left</i>
                </div>
                <h5 class="card-title"> Pulang Hari Ini</h5>
              </div>
              <div class="card-body">
                @if($pulang->count()>0)
                <div class="masuk">
                    @foreach($pulang as $key => $plng)
                    <div>
                        <table>
                            <tr>
                                <td>
                                    @if($plng->foto == null)
                                    <a href="">
                                        <img width="70px" height="70px" style="border-radius: 50%" src="/img/user.png" />
                                    </a>
                                    @else
                                    <a href="{{\Illuminate\Support\Facades\Storage::url($plng->foto)}}" target="_blank">
                                        <img width="70px" height="70px" style="border-radius: 50%" src="{{\Illuminate\Support\Facades\Storage::url($plng->foto)}}" />
                                    </a>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    <small>{{$plng->karyawan->nama}}</small>
                                </td>
                            </tr>
                        </table>
                    </div>
                    @endforeach
                </div>
                @else
                <br>
                <center>
                    <h6>Belum ada data!</h6>
                </center>
                @endif
              </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.masuk').slick({
                slidesToShow: 3,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 2000,
                dots:true
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            var interval = setInterval(function() {
                var momentNow = moment();
                var month = moment().format('MMMM');
                var day = moment().format('dddd');

                console.log(month);

                if(month == "January"){
                    month = "Januari";
                }else if(month == "February"){
                    month = "Februari";
                }else if(month == "March"){
                    month = "Maret";
                }else if(month == "April"){
                    month = "April";
                }else if(month == "May"){
                    month = "Mei";
                }else if(month == "June"){
                    month = "Juni";
                }else if(month == "July"){
                    month = "Juli";
                }else if(month == "August"){
                    month = "Agustus";
                }else if(month == "September"){
                    month = "September";
                }else if(month == "October"){
                    month = "Oktober";
                }else if(month == "November"){
                    month = "November";
                }else if(month == "December"){
                    month = "Desember";
                }

                if(day == "Sunday"){
                    day = "Minggu";
                }else if(day == "Monday"){
                    day = "Senin";
                }else if(day == "Tuesday"){
                    day = "Selasa";
                }else if(day == "Wednesday"){
                    day = "Rabu";
                }else if(day == "Thursday"){
                    day = "Kamis";
                }else if(day == "Friday"){
                    day = "Jumat";
                }else if(day == "Saturday"){
                    day = "Sabtu";
                }

                $('#date-part').html('<b>'+day + ', ' + momentNow.format('DD') + ' ' + month + ' ' + momentNow.format('YYYY')+'</b>');
                $('#time-part').html(momentNow.format('HH.mm.ss'));
            }, 100);
        });
    </script>
@endsection
