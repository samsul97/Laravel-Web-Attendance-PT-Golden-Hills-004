@extends('user/master/master')

@section('title', 'Catatan Kehadiran')

@section('active3', 'active')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header card-header-danger">
                    <div class="card-icon">
                        <i class="material-icons" data-notify="icon">note</i>
                    </div>
                    <h5 class="card-title">Catatan Kehadiran</h5>
                </div>
              <div class="card-body">
                <div class="table-responsive">
                    @if($absensi->count() > 0)
                    <table  id="jsWebKitTable" class="table table-hover">
                        <thead>
                            <tr>
                                <td class="text-left"><b>Tanggal</b></td>
                                <td class="text-left"><b>Waktu</b></td>
                                <td class="text-center"><b>Keterangan</b></td>
                            </tr>
                        </thead>
                        <tbody>
                            @for($i=0; $i<count($absensi); $i++)
                            <tr>
                                <td class="text-left">
                                    {{\Carbon\Carbon::parse($absensi[$i]->tgl)->format('d/m/Y')}}
                                </td>
                                <td class="text-left">
                                    {{\Carbon\Carbon::parse($absensi[$i]->waktu)->format('H.i')}}
                                </td>
                                <td class="text-center">
                                    {{$absensi[$i]->in_out}}
                                </td>
                            </tr>
                            @endfor
                        </tbody>
                    </table>
                    @else
                    <div class="alert alert-warning">
                        <span>
                            <b> Info - </b> Data tidak ditemukan!
                        </span>
                    </div>
                    @endif

                    @if($absensi->count() > 3)
                        <center><button class="btn btn-primary" id="show" type="button" value="Load More Table Rows..... "><i class="material-icons" data-notify="icon">cached</i></button></center>
                    @endif
                </div>
              </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
    <script>
        $(function() {
            var totalrowshidden;
            var rows2display = 3;
            var rem = 0;
            var rowCount = 0;
            var forCntr;
            var forCntr1;
            var MaxCntr = 0;

            $('#hide').click(function() {
                var rowCount = $('#jsWebKitTable tr').length;

                rowCount = rowCount/2;
                rowCount = Math.round(rowCount)

                for (var i = 0; i < rowCount; i++) {
                    $('tr:nth-child('+ i +')').hide(300);
                }
            });

            $('#show').click(function() {
                rowCount = $('#jsWebKitTable tr').length;

                MaxCntr=forStarter+rows2display;

                if (forStarter<=$('#jsWebKitTable tr').length){

                    for (var i = forStarter; i < MaxCntr; i++){
                        $('tr:nth-child('+ i +')').show(200);
                    }

                    forStarter=forStarter+rows2display
                }else{
                    $('#show').hide();
                }
            });


            $(document).ready(function() {
                var rowCount = $('#jsWebKitTable tr').length;

                for (var i = $('#jsWebKitTable tr').length; i > rows2display; i--) {
                    rem = rem + 1;
                    $('tr:nth-child('+ i +')').hide(200);

                }

                forCntr=$('#jsWebKitTable tr').length-rem;
                forStarter=forCntr+1
            });
        });
    </script>
@endsection
