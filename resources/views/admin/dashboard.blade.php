@extends('admin/master/master')

@section('title', 'Dashboard | Abdul Admin')

@section('active_1', 'active')

@section('content')
<div class="content">
    <!-- Animated -->
    <div class="animated fadeIn">
        <!-- Widgets  -->
        <div class="row">
            <div class="col-sm-12 mb-4">
                <div class="card-group">
                    <div class="card col-md-6 no-padding ">
                        <div class="card-body">
                            <div class="h1 text-muted text-right mb-4">
                                <i class="fa fa-users"></i>
                            </div>

                            <div class="h4 mb-0">
                                <span class="count">{{$karyawan_count}}</span>
                            </div>

                            <small class="text-muted text-uppercase font-weight-bold">Karyawan</small>
                            <div class="progress progress-xs mt-3 mb-0 bg-flat-color-1" style="width: 40%; height: 5px;"></div>
                        </div>
                    </div>
                    <div class="card col-md-6 no-padding ">
                        <div class="card-body">
                            <div class="h1 text-muted text-right mb-4">
                                <i class="fa fa-book"></i>
                            </div>
                            <div class="h4 mb-0">
                                <span class="count">{{$absensi_today_in_count}}</span>
                            </div>
                            <small class="text-muted text-uppercase font-weight-bold">Absensi Masuk Hari Ini</small>
                            <div class="progress progress-xs mt-3 mb-0 bg-flat-color-2" style="width: 40%; height: 5px;"></div>
                        </div>
                    </div>

                    <div class="card col-md-6 no-padding ">
                        <div class="card-body">
                            <div class="h1 text-muted text-right mb-4">
                                <i class="fa fa-book"></i>
                            </div>
                            <div class="h4 mb-0">
                                <span class="count">{{$absensi_today_out_count}}</span>
                            </div>
                            <small class="text-muted text-uppercase font-weight-bold">Absensi Pulang Hari Ini</small>
                            <div class="progress progress-xs mt-3 mb-0 bg-flat-color-2" style="width: 40%; height: 5px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Widgets -->
        <!-- cal -->
        <div class="orders">
            <div class="row">
                <div class="col-xl-12">
                  <!-- Calender Chart Weather  -->
                  <div class="row">
                      <div class="col-md-12 col-lg-12">
                          <div class="card">
                              <div class="card-body">
                                  <!-- <h4 class="box-title">Chandler</h4> -->
                                  <div class="calender-cont widget-calender">
                                      <div id="calendar"></div>
                                  </div>
                              </div>
                          </div><!-- /.card -->
                      </div>
                  </div>
                  <!-- /Calender Chart Weather -->
                </div>  <!-- /.col-lg-8 -->

            </div>
        </div>
        <!-- /.cal -->
    </div>
    <!-- .animated -->
</div>
@endsection

