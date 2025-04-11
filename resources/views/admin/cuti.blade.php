@extends('admin/master/master')

@section('title', 'Cuti | Abdul Admin')

@section('active_7', 'active')

@section('content')

        <div class="breadcrumbs">
            <div class="breadcrumbs-inner">
                <div class="row m-0">
                    <div class="col-sm-4">
                        <div class="page-header float-left">
                            <div class="page-title">
                                <h1>Kelola Cuti Karyawan</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="page-header float-right">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="#">Dashboard</a></li>
                                    <li class="active">Cut Off</li>
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

                            <div class="card-body">
                                <div class="col-lg-3 col-md-6">
                                    <button type="button" class="btn btn-info mb-1" data-toggle="modal" data-target="#tambahCuti"><i class="fa fa-plus-square"></i>
                                    Tambah Cuti
                                    </button>
                                </div>

                                <!-- Modal Tambah Cuti -->

                                <div class="modal fade" id="tambahCuti" role="dialog" aria-labelledby="smallModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="mediumModalLabel"><strong>Tambah Cuti</strong></h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form autocomplete="off" action="/admin/cuti/tambah" autocomplete="off" method="post" enctype="multipart/form-data" class="form-horizontal">

                                                    {{ csrf_field()}}

                                                    <div class="row form-group">
                                                        <div class="col col-md-3">
                                                            <label for="text-input" class=" form-control-label">Nama</label>
                                                        </div>
                                                        <div class="col-5">
                                                            <select name="nip" id="nip" class="form-control" style="width:100%" required>
                                                                <option value="">--- Pilih Karyawan ---</option>
                                                                @foreach($karyawan as $kar)
                                                                <option value="{{$kar->nip}}">{{$kar->nip}} {{$kar->nama}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-4"><input type="text" id="jabatan" name="jabatan" class="form-control" required readonly></div>
                                                    </div>

                                                    <div class="row form-group">
                                                        <div class="col col-md-3">
                                                            <label for="text-input" class=" form-control-label">Tanggal Cuti</label>
                                                        </div>
                                                        <div class="col-5"><input type="text" id="start_date" name="start_date" placeholder="Dari" class="form-control" required></div>
                                                        <div class="col-4"><input type="text" id="end_date" name="end_date" placeholder="Sampai" class="form-control" required></div>
                                                    </div>

                                                    <div class="row form-group">
                                                        <div class="col col-md-3">
                                                            <label for="text-input" class=" form-control-label">Jenis Cuti</label>
                                                        </div>
                                                        <div class="col-12 col-md-9">
                                                            <select name="jenis_cuti" class="form-control" style="width:100%" required>
                                                                <option value="">--- Pilih salah satu ---</option>
                                                                <option value="Tahunan">Tahunan</option>
                                                                <option value="Khusus">Khusus</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="row form-group">
                                                        <div class="col col-md-3">
                                                            <label for="text-input" class=" form-control-label">Keterangan/Alasan</label>
                                                        </div>
                                                        <div class="col-12 col-md-9">
                                                            <textarea name="alasan" placeholder="Masukkan Keterangan/Alasan Cuti" class="form-control" required></textarea>
                                                            <!-- <small class="form-text text-muted">Tuliskan nama lengkap!</small> -->
                                                        </div>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-primary">Tambah</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal Ubah Cuti -->
                                <div class="modal fade" id="ubahCuti" tabindex="-1" role="dialog" aria-labelledby="smallModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="mediumModalLabel"><strong>Ubah Cuti</strong></h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="/admin/cuti/ubah" autocomplete="off" method="post" enctype="multipart/form-data" class="form-horizontal">

                                                    {{ csrf_field()}}

                                                    <input type="text" id="id_cuti" name="id_cuti" class="form-control" value="" hidden readonly>

                                                    <div class="row form-group">
                                                        <div class="col col-md-3">
                                                            <label for="text-input" class=" form-control-label">Nama</label>
                                                        </div>
                                                        <div class="col-5">
                                                            <select name="nip" id="update_nip" class="form-control" style="width:100%" required>
                                                                <option value="">--- Pilih Karyawan ---</option>
                                                                @foreach($karyawan as $kar)
                                                                <option value="{{$kar->nip}}">{{$kar->nip}} {{$kar->nama}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-4"><input type="text" id="update_jabatan" name="jabatan" class="form-control" required readonly></div>
                                                    </div>

                                                    <div class="row form-group">
                                                        <div class="col col-md-3">
                                                            <label for="text-input" class="form-control-label">Tanggal Cuti</label>
                                                        </div>
                                                        <div class="col-5"><input type="text" id="update_start_date" name="start_date" placeholder="Dari" class="form-control" required></div>
                                                        <div class="col-4"><input type="text" id="update_end_date" name="end_date" placeholder="Sampai" class="form-control" required></div>
                                                    </div>

                                                    <div class="row form-group">
                                                        <div class="col col-md-3">
                                                            <label for="text-input" class="form-control-label">Jenis Cuti</label>
                                                        </div>
                                                        <div class="col-12 col-md-9">
                                                            <select name="jenis_cuti" id="update_jenis_cuti" class="form-control" style="width:100%" required>
                                                                <option value="">--- Pilih salah satu ---</option>
                                                                <option value="Tahunan">Tahunan</option>
                                                                <option value="Khusus">Khusus</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="row form-group">
                                                        <div class="col col-md-3">
                                                            <label for="text-input" class="form-control-label">Keterangan/Alasan</label>
                                                        </div>
                                                        <div class="col-12 col-md-9">
                                                            <textarea id="alasan" name="alasan" placeholder="Masukkan Keterangan/Alasan Cuti" class="form-control" required></textarea>
                                                            <!-- <small class="form-text text-muted">Tuliskan nama lengkap!</small> -->
                                                        </div>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-primary">Ubah</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal Hapus Cuti -->
                                <div class="modal fade" id="hapusCuti" tabindex="-1" role="dialog" aria-labelledby="smallModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-md" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="mediumModalLabel"><strong>Hapus Cuti</strong></h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">

                                                <h5>Apakah anda yakin?</h5>

                                                <form action="/admin/cuti/hapus" method="post" enctype="multipart/form-data" class="form-horizontal">

                                                    {{ csrf_field()}}

                                                    <div class="row form-group" hidden>
                                                        <div class="col col-md-3">
                                                            <label for="number-input" class=" form-control-label">ID Cuti</label>
                                                        </div>
                                                        <div class="col-12 col-md-9">
                                                            <input type="text" id="id_cuti" name="id_cuti" class="form-control" readonly required>
                                                        </div>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-primary">Hapus</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <br>

                                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>NIK</th>
                                            <th>Jenis Cuti</th>
                                            <th>Mulai</th>
                                            <th>Hingga</th>
                                            <th>Alasan</th>
                                            <th>Tgl Pengajuan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($cuti as $key => $c)
                                        <tr>
                                            <td>{{++$key}}</td>
                                            <td>{{$c->nip}}</td>
                                            <td>{{$c->jenis_cuti}}</td>
                                            <td>{{\Carbon\Carbon::parse($c->mulai)->format('d-m-Y')}}</td>
                                            <td>{{\Carbon\Carbon::parse($c->hingga)->format('d-m-Y')}}</td>
                                            <td>{{$c->alasan}}</td>
                                            <td>{{\Carbon\Carbon::parse($c->tgl_pengajuan)->format('d-m-Y')}}</td>
                                            <td>

                                            <button type="button" class="btn btn-success btn-sm"
                                                data-target="#ubahCuti"
                                                data-toggle="modal"
                                                data-id_cuti="{{$c->id_cuti}}"
                                                data-nip="{{$c->nip}}"
                                                data-jenis_cuti="{{$c->jenis_cuti}}"
                                                data-mulai="{{\Carbon\Carbon::parse($c->mulai)->format('d-m-Y')}}"
                                                data-hingga="{{\Carbon\Carbon::parse($c->hingga)->format('d-m-Y')}}"
                                                data-alasan="{{$c->alasan}}"
                                            >
                                                <i class="fa fa-edit"></i>&nbsp;
                                                Ubah
                                            </button>

                                            <button type="button" class="btn btn-danger btn-sm"
                                                data-target="#hapusCuti"
                                                data-toggle="modal"
                                                data-id_cuti="{{$c->id_cuti}}"
                                            >
                                                <i class="fa fa-trash"></i>&nbsp;
                                                Hapus
                                            </button>

                                            </td>
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
            $('.js-example-basic-single').select2({
                theme: "classic",
            });
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

            $('#update_start_date').datepicker({
                uiLibrary: 'bootstrap4',
                iconsLibrary: 'fontawesome',
                format: 'dd-mm-yyyy',
                maxDate: function () {
                    return $('#end_date').val();
                }
            });
            $('#update_end_date').datepicker({
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

                $('#nip').on('change', function() {
                    var formData = new FormData();
                    formData.append('_token', '{{ csrf_token() }}');
                    formData.append('nip', this.value);
                    //console.log(this.value)

                    $.ajax({
                        url: '/admin/cuti/getJabatan',
                        type: "POST",
                        data: formData,
                        cache:false,
                        contentType: false,
                        processData: false,
                        dataType: "json",
                        success: function( res ){
                            let jabatan = document.getElementById('jabatan')
                            jabatan.value = res.jabatan
                            //console.log(res.jabatan)
                        }
                    });
                });

                $('#update_nip').on('change', function() {
                    var formData = new FormData();
                    formData.append('_token', '{{ csrf_token() }}');
                    formData.append('nip', this.value);
                    //console.log(this.value)

                    $.ajax({
                        url: '/admin/cuti/getJabatan',
                        type: "POST",
                        data: formData,
                        cache:false,
                        contentType: false,
                        processData: false,
                        dataType: "json",
                        success: function( res ){
                            let jabatan = document.getElementById('update_jabatan')
                            jabatan.value = res.jabatan
                            //console.log(res.jabatan)
                        }
                    });
                });

                $('#tambahCuti').on('show.bs.modal', (event) => {
                    var n = document.getElementById('update_nip');
                    n.value = '';

                    var c = document.getElementById('update_jenis_cuti');
                    c.value = '';
                })

                $('#ubahCuti').on('show.bs.modal', (event) => {
                    const button = $(event.relatedTarget);
                    const id_cuti = button.data('id_cuti');
                    const nip = button.data('nip');
                    const jenis_cuti = button.data('jenis_cuti');
                    const mulai = button.data('mulai');
                    const hingga = button.data('hingga');
                    const alasan = button.data('alasan');

                    var n = document.getElementById('update_nip');
                    n.value = nip;

                    var c = document.getElementById('update_jenis_cuti');
                    c.value = jenis_cuti;

                    let modal = $(this);
                    modal.find('.modal-body #id_cuti').val(id_cuti);
                    modal.find('.modal-body #update_start_date').val(mulai);
                    modal.find('.modal-body #update_end_date').val(hingga);
                    modal.find('.modal-body #alasan').val(alasan);

                    var formData = new FormData();
                    formData.append('_token', '{{ csrf_token() }}');
                    formData.append('nip', nip);

                    $.ajax({
                        url: '/admin/cuti/getJabatan',
                        type: "POST",
                        data: formData,
                        cache:false,
                        contentType: false,
                        processData: false,
                        dataType: "json",
                        success: function( res ){
                            modal.find('.modal-body #update_jabatan').val(res.jabatan)
                        }

                    })

                });
            });
        </script>

        <script type="text/javascript">
            $(document).ready(function() {
                $('#hapusCuti').on('show.bs.modal', (event) => {
                    const button = $(event.relatedTarget);
                    const id_cuti = button.data('id_cuti');

                    let modal = $(this);
                    modal.find('.modal-body #id_cuti').val(id_cuti);
                });
            });
        </script>

@endsection
