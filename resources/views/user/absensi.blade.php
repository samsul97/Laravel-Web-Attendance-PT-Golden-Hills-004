@extends('user/master/master')

@section('title', 'Absensi')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-danger">
                <h4 class="card-title">Form Absensi</h4>
              </div>
              <div class="card-body">
                <form method="POST" action="/user/absensi/proses" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="row" >
                        <div class="col-md-12">
                            <div id="mapid"></div>
                        </div>
                        <div class="col-md-12">
                            <button type="button" class="btn btn-info" onclick="getLocation()">Dapatkan Lokasi</button>
                        </div>
                    </div>

                    <br>
                    <br>

                    <div class="row" hidden>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="bmd-label-floating">NIP</label>
                                <input type="text" id="nip" name="nip" value="{{$nip}}" class="form-control" required readonly>
                            </div>
                        </div>
                    </div>

                    <div class="row" hidden>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="bmd-label-floating">In-Out</label>
                                <input type="text" id="in_out" name="in_out" value="{{$in_out}}" class="form-control" required readonly>
                            </div>
                        </div>
                    </div>

                    <div class="row" hidden>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Lokasi</label>
                                <input type="text" id="lokasi" name="lokasi" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Shift</label>
                                <select name="shift" id="shift" class="form-control" required>
                                    <option value="">--- Pilih shift ---</option>
                                    @foreach($shift as $sf)
                                    <option value="{{$sf->id_shift}}">{{$sf->desc_shift}} ({{$sf->clock_in}}-{{$sf->clock_out}})</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Deskripsi</label>
                                <input type="text" id="deskripsi" name="deskripsi" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <input type="text" id="foto" name="foto" class="form-control" style="display: none" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 contentarea">
                            <div class="camera">
                                <video id="video">Video stream not available.</video>
                            </div>
                            <button type="button" id="startbutton" class="btn btn-info">Ambil Foto</button>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 contentarea">
                            <canvas id="canvas"></canvas>
                            <div class="output">
                                <img id="photo" alt="The screen capture will appear in this box.">
                            </div>
                        </div>
                    </div>

                    <br><br>
                    <button type="submit" onclick="myFunction()" class="btn btn-success pull-right">Submit</button>
                    <div class="clearfix"></div>
                </form>
              </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')

<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
  integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
  crossorigin=""></script>

<script>
    function getLocation(){

        const mapid = document.getElementById("mapid");
        mapid.style.height = "300px";
        
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function () {}, function () {}, {});

            navigator.geolocation.getCurrentPosition(function(location) {
    
                let latlng = new L.LatLng(location.coords.latitude, location.coords.longitude);
    
                let mymap = L.map('mapid').setView(latlng, 13)
    
                L.tileLayer('https://api.mapbox.com/styles/v1/mapbox/outdoors-v9/tiles/256/{z}/{x}/{y}?access_token=pk.eyJ1IjoiaGFyc2F5YW1hbmkiLCJhIjoiY2tna214ZjhhMDdodDJ5cHB5emt6dGt2OSJ9.eoph-RE6LhOpp0F7XGZ6xw', {
                        maxZoom: 20
                }).addTo(mymap);
    
                let marker = L.marker(latlng).addTo(mymap);
    
                $.ajax({
                    url: "https://dataservice.accuweather.com/locations/v1/cities/geoposition/search",
                    type:"GET",
                    data : {
                        "apikey": "boCFKdy0IAYZh7p68IHY3VTZsB3oGoZG",
                        "q": location.coords.latitude+","+location.coords.longitude,
                        "language": "en-us",
                        "details": false,
                        "toplevel":false
                    },
                    dataType: "json",
                    success: function(res){
                        location = res.LocalizedName+", "+res.SupplementalAdminAreas[1].LocalizedName+", "+res.SupplementalAdminAreas[0].LocalizedName;
                        $('#lokasi').val(location);
                    }
                });
            },function error(msg) {
                alert('Please enable your GPS position feature.');
            }, {timeout:10000});
        }else{
            alert("Geolocation API is not supported in your browser.");
        }
    }
</script>

<script>
    /* JS comes here */
    (function() {

        var width = 230; // We will scale the photo width to this
        var height = 0; // This will be computed based on the input stream

        var streaming = false;

        var video = null;
        var canvas = null;
        var photo = null;
        var startbutton = null;
        var input = null;

        function startup() {
            video = document.getElementById('video');
            canvas = document.getElementById('canvas');
            photo = document.getElementById('photo');
            startbutton = document.getElementById('startbutton');
            input = document.getElementById('foto');

            navigator.mediaDevices.getUserMedia({
                    video: true,
                    audio: false
                })
                .then(function(stream) {
                    video.srcObject = stream;
                    video.play();
                })
                .catch(function(err) {
                    console.log("An error occurred: " + err);
                });

            video.addEventListener('canplay', function(ev) {
                if (!streaming) {
                    height = video.videoHeight / (video.videoWidth / width);

                    if (isNaN(height)) {
                        height = width / (4 / 3);
                    }

                    video.setAttribute('width', width);
                    video.setAttribute('height', height);
                    canvas.setAttribute('width', width);
                    canvas.setAttribute('height', height);
                    streaming = true;
                }
            }, false);

            startbutton.addEventListener('click', function(ev) {
                takepicture();
                ev.preventDefault();
            }, false);

            clearphoto();
        }

        function clearphoto() {
            var context = canvas.getContext('2d');
            context.fillStyle = "#AAA";
            context.fillRect(0, 0, canvas.width, canvas.height);

            var data = canvas.toDataURL('image/png');
            photo.setAttribute('src', data);
        }

        function takepicture() {
            var context = canvas.getContext('2d');
            if (width && height) {
                canvas.width = width;
                canvas.height = height;
                context.drawImage(video, 0, 0, width, height);

                var data = canvas.toDataURL('image/png');;
                photo.setAttribute('src', data);

                $.ajax({
                url: "/user/absensi/getFoto",
                type:"POST",
                data : {
                    "_token": "{{ csrf_token() }}",
                    "foto":data
                },
                dataType: "json",
                success: function(res){
                    var url = 'public/' + res.url;
                    input.setAttribute('value', url);
                }
            });

            } else {
                clearphoto();
            }
        }

        window.addEventListener('load', startup, false);
    })();
</script>
<script>
    function myFunction() {
      var foto = document.getElementById("foto").value;
      
      if(foto == ''){
          alert('Anda belum melakukan swafoto!');
      }
    }
</script>
@endsection

@section('style')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
    integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
    crossorigin=""/>

    <style>
        /* CSS comes here */
        #video {
            width: 230px;
            height: auto;
            margin-left: auto;
            margin-right: auto;
        }

        #photo {
            width: 230px;
            height: auto;
            margin-left: auto;
            margin-right: auto;
        }

        #canvas {
            display: none;
        }

        .camera {
            width: 230px;
            display: inline-block;
        }

        .output {
            width: 230px;
            display: inline-block;
        }

        #startbutton {
            display: block;
            position: relative;
            margin-left: auto;
            margin-right: auto;
            bottom: 36px;
            padding: 5px;
            cursor: pointer;
        }

        .contentarea {
            font-size: 16px;
            font-family: Arial;
            text-align: center;
        }
    </style>
@endsection
