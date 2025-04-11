@extends('admin/master/master')

@section('title', 'Organisasi | Abdul Admin')

@section('active_5', 'active')

@section('content')

        <div class="breadcrumbs">
            <div class="breadcrumbs-inner">
                <div class="row m-0">
                    <div class="col-sm-4">
                        <div class="page-header float-left">
                            <div class="page-title">
                                <h1>Kelola Organisasi</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="page-header float-right">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="#">Dashboard</a></li>
                                    <li class="active">Organisasi</li>
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
                                <strong class="card-title">Kelola Organisasi</strong>
                            </div>

                            <div class="card-body">

                                <div class="col-lg-3 col-md-6">
                                    <button type="button" class="btn btn-info mb-1" data-toggle="modal" data-target="#tambahOrganisasi"><i class="fa fa-plus-square"></i>
                                    Tambah Organisasi
                                    </button>
                                </div>

                                <!-- Modal Tambah Organisasi -->

                                <div class="modal fade" id="tambahOrganisasi" role="dialog" aria-labelledby="smallModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="mediumModalLabel"><strong>Tambah Organisasi</strong></h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form autocomplete="off" action="/admin/organisasi/tambah" method="post" enctype="multipart/form-data" class="form-horizontal">

                                                    {{ csrf_field()}}

                                                    <div class="row form-group">
                                                        <div class="col col-md-3">
                                                            <label for="text-input" class=" form-control-label">Nama</label>
                                                        </div>
                                                        <div class="col-12 col-md-9">
                                                            <input type="text" id="nama" name="nama" placeholder="Masukkan Nama Organisasi" class="form-control" required>
                                                        </div>
                                                    </div>

                                                    <div class="row form-group">
                                                        <div class="col col-md-3">
                                                            <label for="text-input" class=" form-control-label">Deskripsi</label>
                                                        </div>
                                                        <div class="col-12 col-md-9">
                                                            <textarea id="deskripsi" name="deskripsi" placeholder="Masukkan Deskripsi" class="form-control" required></textarea>
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

                                <!-- Modal Ubah Organisasi -->
                                <div class="modal fade" id="ubahOrganisasi" tabindex="-1" role="dialog" aria-labelledby="smallModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="mediumModalLabel"><strong>Ubah Organisasi</strong></h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form autocomplete="off" action="/admin/organisasi/ubah" method="post" enctype="multipart/form-data" class="form-horizontal">

                                                    {{ csrf_field()}}

                                                    <div class="row form-group">
                                                        <div class="col col-md-3">
                                                            <label for="text-input" class=" form-control-label">ID Organisasi</label>
                                                        </div>
                                                        <div class="col-12 col-md-9">
                                                            <input type="text" id="id_organisasi" name="id_organisasi" class="form-control" readonly required>
                                                        </div>
                                                    </div>

                                                    <div class="row form-group">
                                                        <div class="col col-md-3">
                                                            <label for="text-input" class=" form-control-label">Nama</label>
                                                        </div>
                                                        <div class="col-12 col-md-9">
                                                            <input type="text" id="nama" name="nama" placeholder="Masukkan Nama Organisasi" class="form-control" required>
                                                        </div>
                                                    </div>

                                                    <div class="row form-group">
                                                        <div class="col col-md-3">
                                                            <label for="text-input" class=" form-control-label">Deskripsi</label>
                                                        </div>
                                                        <div class="col-12 col-md-9">
                                                            <input type="text" id="deskripsi" name="deskripsi" placeholder="Masukkan Deskripsi" class="form-control" required>
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

                                <!-- Modal Hapus Organisasi -->
                                <div class="modal fade" id="hapusOrganisasi" tabindex="-1" role="dialog" aria-labelledby="smallModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-md" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="mediumModalLabel"><strong>Hapus Organisasi</strong></h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">

                                                <h5>Apakah anda yakin?</h5>

                                                <form autocomplete="off" action="/admin/organisasi/hapus" method="post" enctype="multipart/form-data" class="form-horizontal">

                                                    {{ csrf_field()}}

                                                    <div class="row form-group" hidden>
                                                        <div class="col col-md-3">
                                                            <label for="number-input" class=" form-control-label">ID Organisasi</label>
                                                        </div>
                                                        <div class="col-12 col-md-9">
                                                            <input type="text" id="id_organisasi" name="id_organisasi" class="form-control" readonly required>
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
                                            <th>Nama Organisasi</th>
                                            <th>Deskripsi</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($organisasi as $key => $org)
                                        <tr>
                                            <td>{{++$key}}</td>
                                            <td>{{$org->nama}}</td>
                                            <td>{{$org->deskripsi}}</td>
                                            <td>

                                            <button type="button" class="btn btn-success btn-sm"
                                                data-target="#ubahOrganisasi"
                                                data-toggle="modal"
                                                data-id_organisasi="{{$org->id_organisasi}}"
                                                data-nama="{{$org->nama}}"
                                                data-deskripsi="{{$org->deskripsi}}"
                                            >
                                                <i class="fa fa-edit"></i>&nbsp;
                                                Ubah
                                            </button>

                                            <button type="button" class="btn btn-danger btn-sm"
                                                data-target="#hapusOrganisasi"
                                                data-toggle="modal"
                                                data-id_organisasi="{{$org->id_organisasi}}"
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
        <script type="text/javascript">
            $(document).ready(function() {
                $('#ubahOrganisasi').on('show.bs.modal', (event) => {
                const button = $(event.relatedTarget);
                const id_organisasi = button.data('id_organisasi');
                const nama = button.data('nama');
                const deskripsi = button.data('deskripsi');

                console.log(id_organisasi);
                console.log(nama);
                console.log(deskripsi);

                let modal = $(this);
                modal.find('.modal-body #id_organisasi').val(id_organisasi);
                modal.find('.modal-body #nama').val(nama);
                modal.find('.modal-body #deskripsi').val(deskripsi);
                });
            });
        </script>

        <script type="text/javascript">
            $(document).ready(function() {
                $('#hapusOrganisasi').on('show.bs.modal', (event) => {
                const button = $(event.relatedTarget);
                const id_organisasi = button.data('id_organisasi');

                let modal = $(this);
                modal.find('.modal-body #id_organisasi').val(id_organisasi);
                });
            });
        </script>

@endsection
