@extends('user/master/master')

@section('title', 'Riwayat Pinjaman')

@section('active4', 'active')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header card-header-danger">
                    <div class="card-icon">
                        <i class="material-icons" data-notify="icon">history</i>
                    </div>
                    <h5 class="card-title">Riwayat Pinjaman</h5>
                </div>
              <div class="card-body">
                @if($pinjaman->count()>0)
                <div class="table-responsive">
                    <table  id="jsWebKitTable" class="table table-hover">
                        <thead>
                            <tr>
                                <td class="text-left"><b>Tanggal</b></td>
                                <td class="text-left"><b>Nominal</b></td>
                                <td class="text-left"><b>Deskripsi</b></td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pinjaman as $pij)
                            <tr>
                                <td class="text-left">
                                    {{\Carbon\Carbon::parse($pij->tgl_pengajuan)->format('d/m/Y')}}
                                </td>
                                <td class="text-left">
                                    Rp.{{$pij->nominal}}
                                </td>
                                <td class="text-left">
                                    {{$pij->deskripsi}}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    @if($pinjaman->count() > 3)
                        <center><button class="btn btn-primary" id="show" type="button" value="Load More Table Rows..... "><i class="material-icons" data-notify="icon">cached</i></button></center>
                    @endif
                </div>
                @else
                <div class="alert alert-warning">
                    <span>
                        <b> Info - </b> Data tidak ditemukan!
                    </span>
                </div>
                @endif
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
