@extends('admin/master/master')

@section('title', 'Absensi | Abdul Admin')

@section('active_2', 'active')

@section('content')

        <div class="breadcrumbs">
            <div class="breadcrumbs-inner">
                <div class="row m-0">
                    <div class="col-sm-4">
                        <div class="page-header float-left">
                            <div class="page-title">
                                <h1>Rekap Absensi</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="page-header float-right">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="#">Dashboard</a></li>
                                    <li class="active">Absensi</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <!-- Animated -->
            <div class="animated fadeIn">
                <!-- Widgets  -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">Rekap Absensi</strong>
                            </div>

                            <div class="card-body">

                                <!-- Modal Pratinjau -->
                                <div class="modal fade" id="pratinjauModal" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="smallModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="mediumModalLabel"><strong>Pratinjau</strong></h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="col-md-12">
                                                    <div class="table-responsive m-t-40" style="clear: both;">
                                                        <table class="table table-hover">
                                                            <thead>
                                                                <tr>
                                                                    <th>No.</th>
                                                                    <th>NIP</th>
                                                                    <th>Nama</th>
                                                                    <th>Tanggal</th>
                                                                    <th>In Out</th>
                                                                    <th>Waktu</th>
                                                                    <th>Shift</th>
                                                                    <th>Ketepatan</th>
                                                                    <th>Lokasi</th>
                                                                    <th>Deskripsi</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="data_detail">

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <form action="/admin/absensi/filter" autocomplete="off" method="post" enctype="multipart/form-data" class="form-horizontal">

                                    {{ csrf_field()}}

                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="text-input" class=" form-control-label">Tanggal</label>
                                        </div>
                                        <div class="col-4"><input type="text" id="start_date" name="start_date" placeholder="Dari" class="form-control" required></div>
                                        <div class="col-4"><input type="text" id="end_date" name="end_date" placeholder="Sampai" class="form-control" required></div>
                                    </div>

                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="text-input" class=" form-control-label">Organisasi</label>
                                        </div>
                                        <div class="col-12 col-md-8">
                                            <select name="organisasi" id="organisasi" class="form-control js-example-basic-single" style="width:100%">
                                                <option value="">--- Pilih Organisasi ---</option>
                                                @foreach($organisasi as $org)
                                                <option value="{{$org->id_organisasi}}">{{$org->nama}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="text-input" class=" form-control-label">Karyawan</label>
                                        </div>
                                        <div class="col-12 col-md-8">
                                            <select name="nip" id="nip" class="form-control js-example-basic-single" style="width:100%">
                                                <option value="">--- Pilih Karyawan ---</option>
                                                @foreach($karyawan as $kar)
                                                <option value="{{$kar->nip}}">{{$kar->nip}} {{$kar->nama}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-actions form-group">
                                        <button type="submit" class="btn btn-primary mb-1"><i class="fa fa-download"></i>
                                            Unduh Rekap
                                        </button>
                                        <button type="button" class="btn btn-primary mb-1" data-toggle="modal" data-target="#pratinjauModal"><i class="fa fa-eye"></i>
                                            Pratinjau
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="card">
                            {{-- <div class="card-header">
                                <a href="/admin/absensi/unduh/{{$absensi}}" target="_blank" class="btn btn-info mb-1">
                                    <i class="fa fa-download"></i>
                                    Unduh
                                </a>
                            </div> --}}

                            <div class="card-body">
                                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Foto</th>
                                            <th>NIP</th>
                                            <th>Nama</th>
                                            <th>Organisasi</th>
                                            <th>Tanggal</th>
                                            <th>In Out</th>
                                            <th>Waktu</th>
                                            <th>Shift</th>
                                            <th>Ketepatan</th>
                                            <th>Lokasi</th>
                                            <th>Deskripsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($absensi as $abs)
                                        <tr>
                                            <td>{{$i+=1}}</td>
                                            <td><a href="{{\Illuminate\Support\Facades\Storage::url($abs->foto)}}" target="_blank">
                                                    <img width="60px" class="img" src="{{\Illuminate\Support\Facades\Storage::url($abs->foto)}}" />
                                                </a>
                                            </td>
                                            <td>{{$abs->nip}}</td>
                                            <td>{{$abs->karyawan->nama}}</td>
                                            <td>{{$abs->karyawan->organisasi->nama}}</td>
                                            <td>{{\Carbon\Carbon::parse($abs->tgl)->format('d-m-Y')}}</td>
                                            <td>{{$abs->in_out}}
                                            <td>{{$abs->waktu}}</td>
                                            <td>{{$abs->shift->desc_shift}} ({{$abs->shift->clock_in}}-{{$abs->shift->clock_out}})</td>
                                            <td>{{$abs->ketepatan}}</td>
                                            <td>{{$abs->lokasi}}</td>
                                            <td>{{$abs->deskripsi}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>

    <script>
        $('.js-example-basic-single').select2();
    </script>

    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>

    <script>
        let today = new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate());
        $('#start_date').datepicker({
            uiLibrary: 'bootstrap4',
            iconsLibrary: 'fontawesome',
            format: 'dd-mm-yyyy',
            maxDate: function () {
                return $('#end_date').val();
            }
        });
        $('#end_date').datepicker({
            uiLibrary: 'bootstrap4',
            iconsLibrary: 'fontawesome',
            format: 'dd-mm-yyyy',
            minDate: function () {
                return $('#start_date').val();
            }
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#pratinjauModal').on('show.bs.modal', (event) => {
            const button = $(event.relatedTarget);
            const start_date = document.getElementById('start_date').value;
            const end_date = document.getElementById('end_date').value;
            const organisasi = document.getElementById('organisasi').value;
            const nip = document.getElementById('nip').value;
            let modal = $(this);

            modal.find('.modal-body #data_detail').empty()

            $.ajax({
                url: "/admin/absensi/pratinjau",
                type:"POST",
                data : {
                    "_token": "{{ csrf_token() }}",
                    "start_date": start_date,
                    "end_date": end_date,
                    "organisasi": organisasi,
                    "nip": nip
                },
                dataType: "json",
                success: function(res){
                    var no = 1

                    for (let i=0; i<res.absensi.length; i++){

                        var html = `
                            <tr>
                                <td>${no++}</td>
                                <td>${res.absensi[i].nip}</td>
                                <td>${res.absensi[i].nama}</td>
                                <td>${res.absensi[i].tgl}</td>
                                <td>${res.absensi[i].in_out}</td>
                                <td>${res.absensi[i].waktu}</td>
                                <td>${res.absensi[i].desc_shift} (${res.absensi[i].clock_in} - ${res.absensi[i].clock_out})</td>
                                <td>${res.absensi[i].ketepatan}</td>
                                <td>${res.absensi[i].lokasi}</td>
                                <td>${res.absensi[i].deskripsi}</td>
                            </tr>
                        `;
                        $('.modal-body #data_detail').append(html);
                    }
                }
            });
            });
        });
    </script>

@endsection
