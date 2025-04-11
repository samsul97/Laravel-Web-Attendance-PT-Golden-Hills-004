@extends('admin/master/master')

@section('title', 'Karyawan | Abdul Admin')

@section('active_3', 'active')

@section('content')

        <div class="breadcrumbs">
            <div class="breadcrumbs-inner">
                <div class="row m-0">
                    <div class="col-sm-4">
                        <div class="page-header float-left">
                            <div class="page-title">
                                <h1>Kelola Karyawan</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="page-header float-right">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="#">Dashboard</a></li>
                                    <li class="active">Karyawan</li>
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
                                <strong class="card-title">Kelola Karyawan</strong>
                            </div>

                            <div class="card-body">

                                <div class="col-lg-3 col-md-6">
                                    <button type="button" class="btn btn-info mb-1" data-toggle="modal" data-target="#tambahKaryawan"><i class="fa fa-plus-square"></i>
                                    Tambah Karyawan
                                    </button>
                                </div>

                                <!-- Modal Tambah Karyawan -->

                                <div class="modal fade" id="tambahKaryawan" role="dialog" aria-labelledby="smallModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="mediumModalLabel"><strong>Tambah Karyawan</strong></h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form autocomplete="off" action="/admin/karyawan/tambah" method="post" enctype="multipart/form-data" class="form-horizontal">

                                                    {{ csrf_field()}}

                                                    <div class="row form-group">
                                                        <div class="col col-md-3">
                                                            <label for="text-input" class=" form-control-label">NIP</label>
                                                        </div>
                                                        <div class="col-12 col-md-9">
                                                            <input type="text" id="nip" name="nip" placeholder="Masukkan NIP" class="form-control" required>
                                                        </div>
                                                    </div>

                                                    <div class="row form-group">
                                                        <div class="col col-md-3">
                                                            <label for="text-input" class=" form-control-label">Nama</label>
                                                        </div>
                                                        <div class="col-12 col-md-9">
                                                            <input type="text" id="nama" name="nama" placeholder="Masukkan Nama" class="form-control" required>
                                                            <small class="form-text text-muted">Tuliskan nama lengkap!</small>
                                                        </div>
                                                    </div>

                                                    <div class="row form-group">
                                                        <div class="col col-md-3">
                                                            <label for="text-input" class=" form-control-label">Tempat Tanggal Lahir</label>
                                                        </div>
                                                        <div class="col-6">
                                                            <select name="tempat_lahir" id="tempat_lahir" class="js-example-basic-single form-control" style="width: 100%;" required>
                                                                <option value="">--- Pilih Tempat Lahir ---</option>
                                                                @foreach($tempat_lahir as $tl)
                                                                <option value="{{$tl->type.' '.$tl->city_name}}">{{$tl->type.' '.$tl->city_name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-3">
                                                            <input type="text" id="tanggal_lahir" name="tanggal_lahir" placeholder="Tanggal Lahir" class="form-control" required>
                                                        </div>
                                                    </div>

                                                    <div class="row form-group">
                                                        <div class="col col-md-3">
                                                            <label for="text-input" class=" form-control-label">Status</label>
                                                        </div>
                                                        <div class="col-12 col-md-9">
                                                            <select name="status" id="status" class="form-control" required>
                                                                <option value="">--- Pilih Status ---</option>
                                                                <option value="Menikah">Menikah</option>
                                                                <option value="Belum Menikah">Belum Menikah</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="row form-group">
                                                        <div class="col col-md-3">
                                                            <label for="text-input" class=" form-control-label">Kontak Darurat</label>
                                                        </div>
                                                        <div class="col-12 col-md-9">
                                                            <input type="text" id="kontak_darurat" name="kontak_darurat" placeholder="Masukkan Kontak Darurat" class="form-control" required>
                                                            <small class="form-text text-muted">Contoh. +628999xxxx</small>
                                                        </div>
                                                    </div>

                                                    <div class="row form-group">
                                                        <div class="col col-md-3">
                                                            <label for="text-input" class=" form-control-label">Email</label>
                                                        </div>
                                                        <div class="col-12 col-md-9">
                                                            <input type="email" id="email1" name="email" placeholder="Masukkan Alamat Email" class="form-control" required>
                                                            <div id="validEmail"></div>
                                                        </div>
                                                    </div>

                                                    <div class="row form-group">
                                                        <div class="col col-md-3">
                                                            <label for="text-input" class=" form-control-label">Media Sosial</label>
                                                        </div>
                                                        <div class="col-4">
                                                            <input type="text" id="facebook" name="facebook" placeholder="Facebook (Optional)" class="form-control">
                                                        </div>
                                                        <div class="col-4">
                                                            <input type="text" id="linkedin" name="linkedin" placeholder="Linked In (Optional)" class="form-control">
                                                        </div>
                                                    </div>

                                                    <div class="row form-group">
                                                        <div class="col col-md-3">
                                                            <label for="text-input" class=" form-control-label"></label>
                                                        </div>
                                                        <div class="col-4">
                                                            <input type="text" id="instagram" name="instagram" placeholder="Instagram (Optional)" class="form-control">
                                                        </div>
                                                        <div class="col-4">
                                                            <input type="text" id="youtube" name="youtube" placeholder="Youtube (Optional)" class="form-control">
                                                        </div>
                                                    </div>

                                                    <div class="row form-group">
                                                        <div class="col col-md-3">
                                                            <label for="text-input" class=" form-control-label">Organisasi</label>
                                                        </div>
                                                        <div class="col-12 col-md-9">
                                                            <select name="organisasi" id="organisasi" class="form-control" required>
                                                                <option value="">--- Pilih Organisasi ---</option>
                                                                @foreach($organisasi as $org)
                                                                <option value="{{$org->id_organisasi}}">{{$org->nama}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="row form-group">
                                                        <div class="col col-md-3">
                                                            <label for="text-input" class=" form-control-label">Jabatan</label>
                                                        </div>
                                                        <div class="col-12 col-md-9">
                                                            <select name="jabatan" id="jabatan" class="form-control" required>
                                                                <option value="">--- Pilih Jabatan ---</option>
                                                                <option value="Manager">Manager</option>
                                                                <option value="Staff">Staff</option>
                                                                <option value="Supervisor">Supervisor</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="row form-group">
                                                        <div class="col col-md-3">
                                                            <label for="text-input" class=" form-control-label">Tanggal Bergabung</label>
                                                        </div>
                                                        <div class="col-12 col-md-9">
                                                            <input type="text" id="tanggal_gabung" name="tanggal_gabung" placeholder="Tanggal Gabung" class="form-control" required>
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

                                <!-- Modal Ubah Karyawan -->
                                <div class="modal fade" id="ubahKaryawan" tabindex="-1" role="dialog" aria-labelledby="smallModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="mediumModalLabel"><strong>Ubah Karyawan</strong></h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form autocomplete="off" action="/admin/karyawan/ubah" method="post" enctype="multipart/form-data" class="form-horizontal">

                                                    {{ csrf_field()}}

                                                    <div class="row form-group">
                                                        <div class="col col-md-3">
                                                            <label for="text-input" class=" form-control-label">NIP</label>
                                                        </div>
                                                        <div class="col-12 col-md-9">
                                                            <input type="text" id="nip" name="nip" placeholder="Masukkan NIP" class="form-control" readonly required>
                                                        </div>
                                                    </div>

                                                    <div class="row form-group">
                                                        <div class="col col-md-3">
                                                            <label for="text-input" class=" form-control-label">Nama</label>
                                                        </div>
                                                        <div class="col-12 col-md-9">
                                                            <input type="text" id="nama" name="nama" placeholder="Masukkan Nama" class="form-control" required>
                                                            <small class="form-text text-muted">Tuliskan nama lengkap!</small>
                                                        </div>
                                                    </div>

                                                    <div class="row form-group">
                                                        <div class="col col-md-3">
                                                            <label for="text-input" class=" form-control-label">Tempat Lahir</label>
                                                        </div>
                                                        <div class="col-6">
                                                            <select name="tempat_lahir" id="tempat_lahir" class="form-control" required>
                                                                <option value="">--- Pilih Tempat Lahir ---</option>
                                                                @foreach($tempat_lahir as $tl)
                                                                <option value="{{$tl->type.' '.$tl->city_name}}">{{$tl->type.' '.$tl->city_name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-3">
                                                            <input type="text" id="tanggal_lahir2" name="tanggal_lahir" placeholder="Tanggal Lahir" class="form-control" required>
                                                        </div>
                                                    </div>

                                                    <div class="row form-group">
                                                        <div class="col col-md-3">
                                                            <label for="text-input" class=" form-control-label">Status</label>
                                                        </div>
                                                        <div class="col-12 col-md-9">
                                                            <select name="status" id="status" class="form-control" required>
                                                                <option value="">--- Pilih Status ---</option>
                                                                <option value="Menikah">Menikah</option>
                                                                <option value="Belum Menikah">Belum Menikah</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="row form-group">
                                                        <div class="col col-md-3">
                                                            <label for="text-input" class=" form-control-label">Kontak Darurat</label>
                                                        </div>
                                                        <div class="col-12 col-md-9">
                                                            <input type="text" id="kontak_darurat" name="kontak_darurat" placeholder="Masukkan Kontak Darurat" class="form-control" required>
                                                            <small class="form-text text-muted">Contoh. +628999xxxx</small>
                                                        </div>
                                                    </div>

                                                    <div class="row form-group">
                                                        <div class="col col-md-3">
                                                            <label for="text-input" class=" form-control-label">Email</label>
                                                        </div>
                                                        <div class="col-12 col-md-9">
                                                            <input type="email" id="email" name="email" placeholder="Masukkan Alamat Email" class="form-control" readonly>
                                                        </div>
                                                    </div>

                                                    <div class="row form-group">
                                                        <div class="col col-md-3">
                                                            <label for="text-input" class=" form-control-label">Media Sosial</label>
                                                        </div>
                                                        <div class="col-4">
                                                            <input type="text" id="facebook" name="facebook" placeholder="Facebook (Optional)" class="form-control">
                                                        </div>
                                                        <div class="col-4">
                                                            <input type="text" id="linkedin" name="linkedin" placeholder="Linked In (Optional)" class="form-control">
                                                        </div>
                                                    </div>

                                                    <div class="row form-group">
                                                        <div class="col col-md-3">
                                                            <label for="text-input" class=" form-control-label"></label>
                                                        </div>
                                                        <div class="col-4">
                                                            <input type="text" id="instagram" name="instagram" placeholder="Instagram (Optional)" class="form-control">
                                                        </div>
                                                        <div class="col-4">
                                                            <input type="text" id="youtube" name="youtube" placeholder="Youtube (Optional)" class="form-control">
                                                        </div>
                                                    </div>

                                                    <div class="row form-group">
                                                        <div class="col col-md-3">
                                                            <label for="text-input" class=" form-control-label">Organisasi</label>
                                                        </div>
                                                        <div class="col-12 col-md-9">
                                                            <select name="organisasi" id="organisasi" class="form-control" required>
                                                                <option value="">--- Pilih Organisasi ---</option>
                                                                @foreach($organisasi as $org)
                                                                <option value="{{$org->id_organisasi}}">{{$org->nama}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="row form-group">
                                                        <div class="col col-md-3">
                                                            <label for="text-input" class=" form-control-label">Jabatan</label>
                                                        </div>
                                                        <div class="col-12 col-md-9">
                                                            <select name="jabatan" id="jabatan" class="form-control" required>
                                                                <option value="">--- Pilih Jabatan ---</option>
                                                                <option value="Manager">Manager</option>
                                                                <option value="Staff">Staff</option>
                                                                <option value="Supervisor">Supervisor</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="row form-group">
                                                        <div class="col col-md-3">
                                                            <label for="text-input" class=" form-control-label">Tanggal Bergabung</label>
                                                        </div>
                                                        <div class="col-12 col-md-9">
                                                            <input type="text" id="tanggal_gabung2" name="tanggal_gabung" placeholder="Tanggal Gabung" class="form-control" required>
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

                                <!-- Modal Hapus Karyawan -->
                                <div class="modal fade" id="hapusKaryawan" tabindex="-1" role="dialog" aria-labelledby="smallModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-md" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="mediumModalLabel"><strong>Hapus Karyawan</strong></h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">

                                                <h5>Apakah anda yakin?</h5>

                                                <form autocomplete="off" action="/admin/karyawan/hapus" method="post" enctype="multipart/form-data" class="form-horizontal">

                                                    {{ csrf_field()}}

                                                    <div class="row form-group" hidden>
                                                        <div class="col col-md-3">
                                                            <label for="number-input" class=" form-control-label">NIP</label>
                                                        </div>
                                                        <div class="col-12 col-md-9">
                                                            <input type="text" id="nip" name="nip" placeholder="Masukkan NIP" class="form-control" readonly required>
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
                                            <th>NIP</th>
                                            <th>Nama</th>
                                            <th>Tanggal Lahir</th>
                                            <th>Email</th>
                                            <th>Tanggal Daftar</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($karyawan as $kar)
                                        <tr>
                                            <td>{{$i+=1}}</td>
                                            <td>{{$kar->nip}}</td>
                                            <td>{{$kar->nama}}</td>
                                            <td>{{$kar->tempat_lahir}}, {{\Carbon\Carbon::parse($kar->tanggal_lahir)->isoFormat('D MMMM Y')}}</td>
                                            <td>{{$kar->email}}</td>
                                            <td>{{\Carbon\Carbon::parse($kar->tgl_daftar)->format('d-m-Y')}}</td>
                                            <td>

                                            <button type="button" class="btn btn-success btn-sm"
                                                data-target="#ubahKaryawan"
                                                data-toggle="modal"
                                                data-nip="{{$kar->nip}}"
                                                data-nama="{{$kar->nama}}"
                                                data-email="{{$kar->email}}"
                                                data-tempat_lahir="{{$kar->tempat_lahir}}"
                                                data-tanggal_lahir="{{\Carbon\Carbon::parse($kar->tanggal_lahir)->format('d-m-Y')}}"
                                                data-status="{{$kar->status}}"
                                                data-kontak_darurat="{{$kar->kontak_darurat}}"
                                                data-facebook="{{$kar->facebook}}"
                                                data-linkedin="{{$kar->linkedin}}"
                                                data-instagram="{{$kar->instagram}}"
                                                data-youtube="{{$kar->youtube}}"
                                                data-organisasi="{{$kar->id_organisasi}}"
                                                data-jabatan="{{$kar->jabatan}}"
                                                data-tgl_gabung="{{\Carbon\Carbon::parse($kar->tgl_daftar)->format('d-m-Y')}}"
                                            >
                                                <i class="fa fa-edit"></i>&nbsp;
                                                Ubah
                                            </button>

                                            <button type="button" class="btn btn-danger btn-sm"
                                                data-target="#hapusKaryawan"
                                                data-toggle="modal"
                                                data-nip="{{$kar->nip}}"
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
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>

    <script>
        $('.js-example-basic-single').select2();
    </script>

    <script type="text/javascript">

        $('#tanggal_lahir').datepicker({
            uiLibrary: 'bootstrap4',
            iconsLibrary: 'fontawesome',
            format: 'dd-mm-yyyy'
        });

        $('#tanggal_lahir2').datepicker({
            uiLibrary: 'bootstrap4',
            iconsLibrary: 'fontawesome',
            format: 'dd-mm-yyyy'
        });

        $('#tanggal_gabung').datepicker({
            uiLibrary: 'bootstrap4',
            iconsLibrary: 'fontawesome',
            format: 'dd-mm-yyyy'
        });

        $('#tanggal_gabung2').datepicker({
            uiLibrary: 'bootstrap4',
            iconsLibrary: 'fontawesome',
            format: 'dd-mm-yyyy'
        });

        $(document).ready(function() {
              $('#ubahKaryawan').on('show.bs.modal', (event) => {
              const button = $(event.relatedTarget);
              const nip = button.data('nip');
              const nama = button.data('nama');
              const email = button.data('email');
              const tempat_lahir = button.data('tempat_lahir');
              const tanggal_lahir = button.data('tanggal_lahir');
              const status = button.data('status');
              const kontak_darurat = button.data('kontak_darurat');
              const facebook = button.data('facebook');
              const linkedin = button.data('linkedin');
              const youtube = button.data('youtube');
              const instagram = button.data('instagram');
              const organisasi = button.data('organisasi');
              const jabatan = button.data('jabatan');
              const tgl_gabung = button.data('tgl_gabung');

              let modal = $(this);
              modal.find('.modal-body #nip').val(nip);
              modal.find('.modal-body #nama').val(nama);
              modal.find('.modal-body #email').val(email);
              modal.find('.modal-body #tempat_lahir').val(tempat_lahir);
              modal.find('.modal-body #tanggal_lahir2').val(tanggal_lahir);
              modal.find('.modal-body #status').val(status);
              modal.find('.modal-body #kontak_darurat').val(kontak_darurat);
              modal.find('.modal-body #facebook').val(facebook);
              modal.find('.modal-body #linkedin').val(linkedin);
              modal.find('.modal-body #youtube').val(youtube);
              modal.find('.modal-body #instagram').val(instagram);
              modal.find('.modal-body #organisasi').val(organisasi);
              modal.find('.modal-body #jabatan').val(jabatan);
              modal.find('.modal-body #tanggal_gabung2').val(tgl_gabung);
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#hapusKaryawan').on('show.bs.modal', (event) => {
            const button = $(event.relatedTarget);
            const nip = button.data('nip');

            let modal = $(this);
            modal.find('.modal-body #nip').val(nip);
            });
        });
    </script>

    <script>
        $(document).ready(function(){
            $('#email1').keyup(function(){
                let email = document.getElementById('email1').value;

                if(email == ""){
                    $('#validEmail').empty();
                }else{
                    $.ajax({
                        url: "/admin/karyawan/email/validasi",
                        type:"POST",
                        data : {
                            "_token": "{{ csrf_token() }}",
                            "email": email
                        },
                        dataType: "json",
                        success: function(res){
                            let valid = res.valid;

                            $('#validEmail').empty();

                            console.log(valid);

                            if(valid == true){
                                $('#validEmail').html(`<small class="badge badge-success">Email Valid</small>`);
                            }else{
                                $('#validEmail').html(`<small class="badge badge-danger">Email Tidak Valid</small>`);
                            }
                        }
                    });
                }
            });
        });
    </script>



@endsection

