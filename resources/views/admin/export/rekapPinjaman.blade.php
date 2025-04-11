<table>
    <thead>
        <tr>
            <th>No</th>
            <th>NIP</th>
            <th>Nama</th>
            <th>Nominal</th>
            <th>Deskripsi</th>
            <th>Tanggal Pengajuan</th>
        </tr>
    </thead>
    <tbody>
    @foreach($pinjaman as $key => $p)
        <tr>
            <td>{{++$key}}</td>
            <td>'{{$p->nip}}</td>
            <td>{{$p->nama}}</td>
            <td>{{$p->nominal}}</td>
            <td>{{$p->deskripsi}}</td>
            <td>{{$p->tgl_pengajuan}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
