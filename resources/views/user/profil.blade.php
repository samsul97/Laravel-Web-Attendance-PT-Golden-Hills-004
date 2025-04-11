@extends('user/master/master')

@section('title', 'Profil')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12" style="margin-top:20px">
            <div class="card card-profile">
                <div class="card-avatar">
                    @if($foto_profil == null)
                    <a target="_blank" href="{{$url_foto}}">
                        <img class="img" id="output" src="/img/user.png" />
                    </a>
                    @else
                    <a target="_blank" href="{{$url_foto}}">
                        <img class="img" id="output" src="{{$url_foto}}" />
                    </a>
                    @endif
                </div>
                <form method="POST" action="/user/profil/gantiFoto" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <p><input type="file"  accept="image/*" name="foto_profil" id="file" onchange="loadFile(event)" style="display: none;"></p>
                    <label for="file" style="cursor: pointer;">Ganti Foto</label>

                    <div class="card-body">
                        {{-- <h6 class="card-category text-gray">update {{$saya->update_at}}</h6> --}}
                        <h4 class="card-title">PROFIL</h4>
                        <br>
                        <center>
                        <table>
                            <tr>
                                <td class="text-right"><b>NIP<b></td>
                                <td class="text-left" style="padding: 5px"> : </td>
                                <td class="text-left"> {{$saya->nip}}</td>
                            </tr>
                            <tr>
                                <td class="text-right"><b>Nama<b></td>
                                <td class="text-left" style="padding: 5px"> : </td>
                                <td class="text-left"> {{$saya->nama}}</td>
                            </tr>
                            <tr>
                                <td class="text-right"><b>Organisasi<b></td>
                                <td class="text-left" style="padding: 5px"> : </td>
                                <td class="text-left"> {{$saya->organisasi->nama}}</td>
                            </tr>
                            <tr>
                                <td class="text-right"><b>Jabatan<b></td>
                                <td class="text-left" style="padding: 5px"> : </td>
                                <td class="text-left"> {{$saya->jabatan}}</td>
                            </tr>
                            <tr>
                                <td class="text-right"><b>TTL<b></td>
                                <td class="text-left" style="padding: 5px"> : </td>
                                <td class="text-left"> {{$saya->tempat_lahir}}, <br>{{\Carbon\Carbon::parse($saya->tanggal_lahir)->isoFormat('D MMMM Y')}}</td>
                            </tr>
                            <tr>
                                <td class="text-right"><b>Status<b></td>
                                <td class="text-left" style="padding: 5px"> : </td>
                                <td class="text-left"> {{$saya->status}}</td>
                            </tr>
                            <tr>
                                <td class="text-right"><b>Kontak Darurat<b></td>
                                <td class="text-left" style="padding: 5px"> : </td>
                                <td class="text-left"> {{$saya->kontak_darurat}}</td>
                            </tr>
                            <tr>
                                <td class="text-right"><b>Tanggal Bergabung<b></td>
                                <td class="text-left" style="padding: 5px"> : </td>
                                <td class="text-left"> {{\Carbon\Carbon::parse($saya->tgl_daftar)->isoFormat('D MMMM Y')}}</td>
                            </tr>
                        </table>
                        <br>
                        <table>
                            <tr>
                                <td style="padding: 10px"><img width="30px" src="/img/instagram.png"></td>
                                <td><span>{{$saya->instagram}}</span></td>
                                <td style="padding: 10px"><img width="30px" src="/img/youtube.png"></td>
                                <td><span>{{$saya->youtube}}</span></td>
                            </tr>
                            <tr>
                                <td style="padding: 10px"><img width="30px" src="/img/facebook.png"></td>
                                <td><span>{{$saya->facebook}}</span></td>
                                <td style="padding: 10px"><img width="30px" src="/img/linkedin.png"></td>
                                <td><span>{{$saya->linkedin}}</span></td>
                            </tr>
                        </table>
                        </center>
                        <br>
                        <p class="card-description">
                            Terdaftar sejak {{\Carbon\Carbon::parse($saya->created_at)->isoFormat('D MMMM Y')}}
                        </p>
                    </div>

                    <button type="submit" class="btn btn-success btn-round">Simpan</button>
                    <br>
                    <br>
                </form>
            </div>
          </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        var loadFile = function(event) {
            var image = document.getElementById('output');
            image.src = URL.createObjectURL(event.target.files[0]);
        };
    </script>
@endsection
