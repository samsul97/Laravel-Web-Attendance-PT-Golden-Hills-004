@extends('admin/master/master')

@section('title', 'Pinjaman | Abdul Admin')

@section('active_6', 'active')

@section('content')

        <div class="breadcrumbs">
            <div class="breadcrumbs-inner">
                <div class="row m-0">
                    <div class="col-sm-4">
                        <div class="page-header float-left">
                            <div class="page-title">
                                <h1>Rekap Pinjaman</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="page-header float-right">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="#">Dashboard</a></li>
                                    <li class="active">Pinjaman</li>
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
                                <strong class="card-title">Rekap Pinjaman</strong>
                            </div>

                            <div class="card-body">

                                <form id="form-pratinjau" autocomplete="off" action="/admin/pinjaman/unduh" method="post" enctype="multipart/form-data" class="form-horizontal">
                                    {{ csrf_field()}}
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="text-input" class=" form-control-label">Nama Karyawan</label>
                                        </div>
                                        <div class="col-12 col-md-8">
                                            <select name="nip" id="select_nip" class="form-control js-example-basic-single" style="width:100%">
                                                    <option value="">--- Pilih Karyawan ---</option>
                                                    @foreach($karyawan as $kar)
                                                        <option value="{{$kar->nip}}">{{$kar->nip}} {{$kar->nama}}</option>
                                                    @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="text-input" class=" form-control-label">Organisasi</label>
                                        </div>
                                        <div class="col-12 col-md-8">
                                            <select name="id_organisasi" id="select_idorganisasi" class="form-control js-example-basic-single" style="width:100%">
                                                    <option value="">--- Pilih Organisasi ---</option>
                                                    @foreach($organisasi as $org)
                                                        <option value="{{$org->id_organisasi}}">{{$org->nama}}</option>
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

                            <div class="card-body">
                                <div class="col-lg-3 col-md-6">
                                    <button type="button" class="btn btn-info mb-1" data-toggle="modal" data-target="#tambahPinjaman"><i class="fa fa-plus-square"></i>
                                    Tambah Pinjaman
                                    </button>
                                </div>

                                <!-- Modal Tambah Pinjaman -->

                                <div class="modal fade" id="tambahPinjaman" role="dialog" aria-labelledby="smallModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="mediumModalLabel"><strong>Tambah Pinjaman</strong></h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="/admin/pinjaman/tambah" method="post" enctype="multipart/form-data" class="form-horizontal">

                                                    {{ csrf_field()}}

                                                    <div class="row form-group">
                                                        <div class="col col-md-3">
                                                            <label for="text-input" class=" form-control-label">Nama Karyawan</label>
                                                        </div>
                                                        <div class="col-12 col-md-9">
                                                            <select name="nip" id="nip" class="form-control js-example-basic-single" style="width:100%" required>
                                                                <option value="">--- Pilih Karyawan ---</option>
                                                                @foreach($karyawan as $kar)
                                                                <option value="{{$kar->nip}}">{{$kar->nip}} {{$kar->nama}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="row form-group">
                                                        <div class="col col-md-3">
                                                            <label for="text-input" class=" form-control-label">Nominal</label>
                                                        </div>
                                                        <div class="col-12 col-md-9">
                                                            <input type="number" id="nominal" name="nominal" placeholder="Masukkan Nominal Pinjaman" class="form-control" required>
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

                                <!-- Modal Ubah Pinjaman -->
                                <div class="modal fade" id="ubahPinjaman" tabindex="-1" role="dialog" aria-labelledby="smallModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="mediumModalLabel"><strong>Ubah Organisasi</strong></h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form autocomplete="off" action="/admin/pinjaman/ubah" method="post" enctype="multipart/form-data" class="form-horizontal">

                                                    {{ csrf_field()}}

                                                    <div class="row form-group">
                                                        <div class="col col-md-3">
                                                            <label for="text-input" class=" form-control-label">ID Pinjaman</label>
                                                        </div>
                                                        <div class="col-12 col-md-9">
                                                            <input type="text" id="id_pinjaman" name="id_pinjaman" class="form-control" readonly required>
                                                        </div>
                                                    </div>

                                                    <div class="row form-group">
                                                        <div class="col col-md-3">
                                                            <label for="text-input" class=" form-control-label">Nama Karyawan</label>
                                                        </div>
                                                        <div class="col-12 col-md-9">
                                                            <select name="nip" id="nip" class="form-control" style="width:100%">
                                                                <option value="">--- Pilih Karyawan ---</option>
                                                                @foreach($karyawan as $kar)
                                                                <option value="{{$kar->nip}}">{{$kar->nip}} {{$kar->nama}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="row form-group">
                                                        <div class="col col-md-3">
                                                            <label for="text-input" class=" form-control-label">Nominal</label>
                                                        </div>
                                                        <div class="col-12 col-md-9">
                                                            <input type="number" id="nominal" name="nominal" placeholder="Masukkan Nominal Pinjaman" class="form-control" required>
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
                                                        <button type="submit" class="btn btn-primary">Ubah</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal Hapus Pinjaman -->
                                <div class="modal fade" id="hapusPinjaman" tabindex="-1" role="dialog" aria-labelledby="smallModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-md" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="mediumModalLabel"><strong>Hapus Pinjaman</strong></h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">

                                                <h5>Apakah anda yakin?</h5>

                                                <form autocomplete="off" action="/admin/pinjaman/hapus" method="post" enctype="multipart/form-data" class="form-horizontal">

                                                    {{ csrf_field()}}

                                                    <div class="row form-group" hidden>
                                                        <div class="col col-md-3">
                                                            <label for="number-input" class=" form-control-label">ID Pinjaman</label>
                                                        </div>
                                                        <div class="col-12 col-md-9">
                                                            <input type="text" id="id_pinjaman" name="id_pinjaman" class="form-control" readonly required>
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

                                <!-- Modal Pritinjau -->
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
                                                                    <th class="text-center">No.</th>
                                                                    <th class="text-center">NIP</th>
                                                                    <th class="text-center">Nama</th>
                                                                    <th class="text-center">Nominal</th>
                                                                    <th class="text-center">Deskripsi</th>
                                                                    <th class="text-center">Tanggal Pengajuan</th>
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

                                <br>

                                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Peminjam</th>
                                            <th>Nominal</th>
                                            <th>Deskripsi</th>
                                            <th>Tgl Pengajuan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($pinjaman as $key => $p)
                                        <tr>
                                            <td>{{++$key}}</td>
                                            <td>{{$p->karyawan->nama}}</td>
                                            <td>{{$p->nominal}}</td>
                                            <td>{{$p->deskripsi}}</td>
                                            <td>{{\Carbon\Carbon::parse($p->tgl_pengajuan)->format('d-m-Y')}}</td>
                                            <td>

                                            <button type="button" class="btn btn-success btn-sm"
                                                data-target="#ubahPinjaman"
                                                data-toggle="modal"
                                                data-id_pinjaman="{{$p->id_pinjaman}}"
                                                data-nip="{{$p->nip}}"
                                                data-nominal="{{$p->nominal}}"
                                                data-deskripsi="{{$p->deskripsi}}"
                                            >
                                                <i class="fa fa-edit"></i>&nbsp;
                                                Ubah
                                            </button>

                                            <button type="button" class="btn btn-danger btn-sm"
                                                data-target="#hapusPinjaman"
                                                data-toggle="modal"
                                                data-id_pinjaman="{{$p->id_pinjaman}}"
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
            $('.js-example-basic-single').select2();
        </script>

        <script type="text/javascript">
            $(document).ready(function() {
                var pratinjauModal= $('#pratinjauModal').on('show.bs.modal', function (e) {
                    e.preventDefault()

                    var select_nip = document.getElementById("select_nip")
                    var nip = select_nip.value

                    var select_org = document.getElementById("select_idorganisasi")
                    var id_organisasi = select_org.value

                    var formData = new FormData()
                    formData.append('_token', '{{ csrf_token() }}')
                    formData.append('nip', nip)
                    formData.append('id_organisasi', id_organisasi)

                    $('.modal-body #data_detail').empty()

                    $.ajax({
                        url: '/admin/pinjaman/pratinjau',
                        type: "POST",
                        data: formData,
                        cache:false,
                        contentType: false,
                        processData: false,
                        dataType: "json",
                        success: function( res ){
                            // console.log(res.data.length)
                            var no = 1
                            for(let i=0; i<res.data.length; i++){
                                var newRow = document.createElement("tr");
                                var cellNo = document.createElement("td")
                                var cellNIP = document.createElement("td");
                                var cellNama = document.createElement("td");
                                var cellNonimal = document.createElement("td");
                                var cellDeskripsi = document.createElement("td");
                                var cellTglPengajuan = document.createElement("td");

                                cellNo.innerHTML = no
                                cellNIP.innerHTML = res.data[i].nip;
                                cellNama.innerHTML = res.data[i].nama;
                                cellNonimal.innerHTML = res.data[i].nominal;
                                cellDeskripsi.innerHTML = res.data[i].deskripsi;
                                cellTglPengajuan.innerHTML = res.data[i].tgl_pengajuan;

                                newRow.append(cellNo);
                                newRow.append(cellNIP);
                                newRow.append(cellNama);
                                newRow.append(cellNonimal);
                                newRow.append(cellDeskripsi);
                                newRow.append(cellTglPengajuan);

                                document.getElementById("data_detail").appendChild(newRow);

                                no++

                            }

                            // Object.keys(res.data).forEach(function(key) {
                            //     console.log(res.data[key])
                            //     var html = `
                            //         <tr>
                            //             <td class="text-center">${++key}</td>
                            //             <td class="text-center">${res.data[key].nip}</td>
                            //             <td class="text-center">${res.data[key].nama}</td>
                            //             <td class="text-center">Rp.${res.data[key].nominal}</td>
                            //             <td class="text-center">${res.data[key].deskripsi}</td>
                            //             <td class="text-center">${res.data[key].tgl_pengajuan}</td>
                            //         </tr>
                            //     `;
                            //     $('.modal-body #data_detail').append(html)

                            // });

                        }
                    })
                });

                //pratinjauModal.modal('show');

                $('#ubahPinjaman').on('show.bs.modal', (event) => {
                    const button = $(event.relatedTarget);
                    const id_pinjaman = button.data('id_pinjaman');
                    const nip = button.data('nip');
                    const nominal = button.data('nominal');
                    const deskripsi = button.data('deskripsi');

                    console.log(id_pinjaman);
                    console.log(nip);
                    console.log(nominal);
                    console.log(deskripsi);

                    let modal = $(this);
                    modal.find('.modal-body #id_pinjaman').val(id_pinjaman);
                    modal.find('.modal-body #nip').val(nip);
                    modal.find('.modal-body #nominal').val(nominal);
                    modal.find('.modal-body #deskripsi').val(deskripsi);
                });
            });
        </script>

        <script type="text/javascript">
            $(document).ready(function() {
                $('#hapusPinjaman').on('show.bs.modal', (event) => {
                    const button = $(event.relatedTarget);
                    const id_pinjaman = button.data('id_pinjaman');

                    let modal = $(this);
                    modal.find('.modal-body #id_pinjaman').val(id_pinjaman);
                });
            });
        </script>

@endsection
