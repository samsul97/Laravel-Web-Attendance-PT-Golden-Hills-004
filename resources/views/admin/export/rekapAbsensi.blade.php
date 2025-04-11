<table>
    <thead>
        <tr>
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
    <tbody>
    @foreach($absensi as $abs)
        @if($id_organisasi != null)
        @if($abs->karyawan->id_organisasi == $id_organisasi)
        <tr>
            <td>{{$abs->nip}}</td>
            <td>{{$abs->karyawan->nama}}</td>
            <td>{{\Carbon\Carbon::parse($abs->tgl)->format('d-m-Y')}}</td>
            <td>{{$abs->in_out}}</td>
            <td>{{$abs->waktu}}</td>
            <td>{{$abs->shift->desc_shift}} ({{$abs->shift->clock_in}}-{{$abs->shift->clock_out}})</td>
            <td>{{$abs->ketepatan}}</td>
            <td>{{$abs->lokasi}}</td>
            <td>{{$abs->deskripsi}}</td>
        </tr>
        @endif
        @else
        <tr>
            <td>{{$abs->nip}}</td>
            <td>{{$abs->karyawan->nama}}</td>
            <td>{{\Carbon\Carbon::parse($abs->tgl)->format('d-m-Y')}}</td>
            <td>{{$abs->in_out}}</td>
            <td>{{$abs->waktu}}</td>
            <td>{{$abs->shift->desc_shift}} ({{$abs->shift->clock_in}}-{{$abs->shift->clock_out}})</td>
            <td>{{$abs->ketepatan}}</td>
            <td>{{$abs->lokasi}}</td>
            <td>{{$abs->deskripsi}}</td>
        </tr>
        @endif
    @endforeach
    </tbody>
</table>
