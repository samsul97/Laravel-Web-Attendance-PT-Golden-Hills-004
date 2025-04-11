@extends('admin/master/master')

@section('title', 'Shift | Abdul Admin')

@section('active_4', 'active')

@section('content')

        <div class="breadcrumbs">
            <div class="breadcrumbs-inner">
                <div class="row m-0">
                    <div class="col-sm-4">
                        <div class="page-header float-left">
                            <div class="page-title">
                                <h1>Kelola Shift</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="page-header float-right">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="#">Dashboard</a></li>
                                    <li class="active">Shift</li>
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
                                <strong class="card-title">Kelola Shift</strong>
                            </div>

                            <div class="card-body">

                                <div class="col-lg-3 col-md-6">
                                    <button type="button" class="btn btn-info mb-1" data-toggle="modal" data-target="#tambahShift"><i class="fa fa-plus-square"></i>
                                    Tambah Shift
                                    </button>
                                </div>

                                <!-- Modal Tambah Shift -->

                                <div class="modal fade" id="tambahShift" role="dialog" aria-labelledby="smallModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="mediumModalLabel"><strong>Tambah Shift</strong></h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form autocomplete="off" action="/admin/shift/tambah" method="post" enctype="multipart/form-data" class="form-horizontal">

                                                    {{ csrf_field()}}

                                                    <div class="row form-group" hidden>
                                                        <div class="col col-md-3">
                                                            <label for="text-input" class=" form-control-label">ID Shift</label>
                                                        </div>
                                                        <div class="col-12 col-md-9">
                                                            <input type="text" id="id_shift" name="id_shift" placeholder="Masukkan ID Shift" class="form-control" value="{{uniqid('sf-', false)}}" required>
                                                        </div>
                                                    </div>

                                                    <div class="row form-group">
                                                        <div class="col col-md-3">
                                                            <label for="text-input" class=" form-control-label">Deskripsi</label>
                                                        </div>
                                                        <div class="col-12 col-md-9">
                                                            <input type="text" id="desc_shift" name="desc_shift" placeholder="Masukkan Deskripsi" class="form-control" required>
                                                        </div>
                                                    </div>

                                                    <div class="row form-group">
                                                        <div class="col col-md-3">
                                                            <label for="text-input" class=" form-control-label">Clock In</label>
                                                        </div>
                                                        <div class="col-12 col-md-9">
                                                            <input type="time" id="clock_in" name="clock_in" placeholder="Masukkan Clock In" class="form-control" required>
                                                        </div>
                                                    </div>

                                                    <div class="row form-group">
                                                        <div class="col col-md-3">
                                                            <label for="text-input" class=" form-control-label">Clock Out</label>
                                                        </div>
                                                        <div class="col-12 col-md-9">
                                                            <input type="time" id="clock_out" name="clock_out" placeholder="Masukkan Clock Out" class="form-control" required>
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

                                <!-- Modal Ubah Shift -->
                                <div class="modal fade" id="ubahShift" tabindex="-1" role="dialog" aria-labelledby="smallModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="mediumModalLabel"><strong>Ubah Shift</strong></h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form autocomplete="off" action="/admin/shift/ubah" method="post" enctype="multipart/form-data" class="form-horizontal">

                                                    {{ csrf_field()}}

                                                    <div class="row form-group">
                                                        <div class="col col-md-3">
                                                            <label for="text-input" class=" form-control-label">ID Shift</label>
                                                        </div>
                                                        <div class="col-12 col-md-9">
                                                            <input type="text" id="id_shift" name="id_shift" placeholder="Masukkan ID Shift" class="form-control" readonly required>
                                                        </div>
                                                    </div>

                                                    <div class="row form-group">
                                                        <div class="col col-md-3">
                                                            <label for="text-input" class=" form-control-label">Deskripsi</label>
                                                        </div>
                                                        <div class="col-12 col-md-9">
                                                            <input type="text" id="desc_shift" name="desc_shift" placeholder="Masukkan Deskripsi" class="form-control" required>
                                                        </div>
                                                    </div>

                                                    <div class="row form-group">
                                                        <div class="col col-md-3">
                                                            <label for="text-input" class=" form-control-label">Clock In</label>
                                                        </div>
                                                        <div class="col-12 col-md-9">
                                                            <input type="time" id="clock_in2" name="clock_in" placeholder="Masukkan Clock In" class="form-control" required>
                                                        </div>
                                                    </div>

                                                    <div class="row form-group">
                                                        <div class="col col-md-3">
                                                            <label for="text-input" class=" form-control-label">Clock Out</label>
                                                        </div>
                                                        <div class="col-12 col-md-9">
                                                            <input type="time" id="clock_out2" name="clock_out" placeholder="Masukkan Clock Out" class="form-control" required>
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

                                <!-- Modal Hapus Shift -->
                                <div class="modal fade" id="hapusShift" tabindex="-1" role="dialog" aria-labelledby="smallModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-md" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="mediumModalLabel"><strong>Hapus Shift</strong></h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">

                                                <h5>Apakah anda yakin?</h5>

                                                <form autocomplete="off" action="/admin/shift/hapus" method="post" enctype="multipart/form-data" class="form-horizontal">

                                                    {{ csrf_field()}}

                                                    <div class="row form-group" hidden>
                                                        <div class="col col-md-3">
                                                            <label for="text-input" class=" form-control-label">ID Shift</label>
                                                        </div>
                                                        <div class="col-12 col-md-9">
                                                            <input type="text" id="id_shift" name="id_shift" placeholder="Masukkan ID Shift" class="form-control" readonly required>
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
                                            <th>ID Shift</th>
                                            <th>Desc Shift</th>
                                            <th>Clock In</th>
                                            <th>Clock Out</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($shift as $shf)
                                        <tr>
                                            <td>{{$i+=1}}</td>
                                            <td>{{$shf->id_shift}}</td>
                                            <td>{{$shf->desc_shift}}</td>
                                            <td>{{$shf->clock_in}}</td>
                                            <td>{{$shf->clock_out}}</td>
                                            <td>

                                            <button type="button" class="btn btn-success btn-sm"
                                                data-target="#ubahShift"
                                                data-toggle="modal"
                                                data-id_shift="{{$shf->id_shift}}"
                                                data-desc_shift="{{$shf->desc_shift}}"
                                                data-clock_in="{{$shf->clock_in}}"
                                                data-clock_out="{{$shf->clock_out}}"
                                            >
                                                <i class="fa fa-edit"></i>&nbsp;
                                                Ubah
                                            </button>

                                            <button type="button" class="btn btn-danger btn-sm"
                                                data-target="#hapusShift"
                                                data-toggle="modal"
                                                data-id_shift="{{$shf->id_shift}}"
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
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>

    {{-- <script>
        $('#clock_in').timepicker({
            format: 'HH:MM',
            uiLibrary: 'bootstrap4',
            mode: '24hr'
        });
    </script>

    <script>
        $('#clock_out').timepicker({
            format: 'HH:MM',
            uiLibrary: 'bootstrap4',
            mode: '24hr'
        });
    </script>

    <script>
        $('#clock_in2').timepicker({
            format: 'HH:MM',
            uiLibrary: 'bootstrap4',
            mode: '24hr'
        });
    </script>

    <script>
        $('#clock_out2').timepicker({
            format: 'HH:MM',
            uiLibrary: 'bootstrap4',
            mode: '24hr'
        });
    </script> --}}

    <script type="text/javascript">
        $(document).ready(function() {
              $('#ubahShift').on('show.bs.modal', (event) => {
              const button = $(event.relatedTarget);
              const id_shift = button.data('id_shift');
              const desc_shift = button.data('desc_shift');
              const clock_in = button.data('clock_in');
              const clock_out = button.data('clock_out');

              let modal = $(this);
              modal.find('.modal-body #id_shift').val(id_shift);
              modal.find('.modal-body #desc_shift').val(desc_shift);
              modal.find('.modal-body #clock_in2').val(clock_in);
              modal.find('.modal-body #clock_out2').val(clock_out);
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#hapusShift').on('show.bs.modal', (event) => {
            const button = $(event.relatedTarget);
            const id_shift = button.data('id_shift');

            let modal = $(this);
            modal.find('.modal-body #id_shift').val(id_shift);
            });
        });
    </script>

@endsection
