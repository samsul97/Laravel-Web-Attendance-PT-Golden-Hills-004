@extends('user/master/master')

@section('title', 'Ganti Password')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-danger">
                <h4 class="card-title">Ganti Password</h4>
              </div>
              <div class="card-body">
                <form autocomplete="off" method="POST" action="/user/gantiPassword/proses">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-12">
                        <div class="form-group">
                            <label class="bmd-label-floating">Password Lama</label>
                            <input type="password" id="pass_lama" name="pass_lama" class="form-control">
                        </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                        <div class="form-group">
                            <label class="bmd-label-floating">Password Baru</label>
                            <input type="password" id="pass_baru" name="pass_baru" class="form-control">
                        </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                        <div class="form-group">
                            <label class="bmd-label-floating">Konfirmasi Password Baru</label>
                            <input type="password" id="pass_baru_konf" name="pass_baru_konf" class="form-control">
                        </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-info pull-right">Simpan</button>
                    <div class="clearfix"></div>
                </form>
              </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

@endsection
