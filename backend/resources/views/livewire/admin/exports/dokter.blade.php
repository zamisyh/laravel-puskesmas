<table border="1">
    <thead>
    <tr>
        <th>No</th>
        <th>No Antrian</th>
        <th>No RM</th>
        <th>Nama Pasien</th>
        <th>Jaminan / No Jaminan</th>
        <th>NIK</th>
        <th>Umur</th>
        <th>Jenis Kelamin</th>
        <th>Tanggal Lahir</th>
        <th>Alamat</th>
        <th>Diagnosa</th>
        <th>TT</th>
        <th>BB</th>
        <th>IMT</th>
        <th>Tekanan Darah</th>
        <th>Hasil Lab</th>
        <th>Jenis Kasus</th>
    </tr>
    </thead>
    <tbody>
    @foreach($dokters as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->pasien->no_antrian }}</td>
            <td>{{ $item->pasien->kode_paramedis }}</td>
            <td>{{ $item->pasien->nama_pasien }}</td>
            <td>{{ $item->pasien->jaminan->nama_jaminan }} / {{ $item->pasien->no_jaminan }}</td>
            <td>{{ $item->pasien->no_ktp }}</td>
            <td>{{ $item->pasien->usia }}</td>
            <td>{{ $item->pasien->jenis_kelamin }}</td>
            <td>{{ $item->pasien->tanggal_lahir }}</td>
            <td>{{ $item->pasien->alamat }}</td>
            <td>
                <ul>
                    @foreach ($item->diagnosaMany as $d)
                        <li> [ {{ $d->code }} ] {{ $d->nama_penyakit }}, </li>
                    @endforeach
                </ul>
            </td>
            <td>{{ $item->tinggi_badan }}</td>
            <td>{{ $item->bb }}</td>
            <td>{{ $item->imt }}</td>
            <td>{{ $item->tekanan_darah }}</td>
            <td>-</td>
            <td>{{ $item->jenis_kasus }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
