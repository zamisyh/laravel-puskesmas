<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal Daftar</th>
            <th>No RM</th>
            <th>Nama Pasien</th>
            <th>Keluhan</th>
            <th>Cek Fisik</th>
            <th>Temperatur</th>
            <th>TD</th>
            <th>N</th>
            <th>HR</th>
            <th>RR</th>
            <th>TB</th>
            <th>BB</th>
            <th>LP</th>
            <th>IMT</th>
            <th>Hasil Periksa</th>
            <th>Jenis Kasus</th>
            <th>Tindakan</th>
            <th>Rencana Pengobatan</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($riwayat_tindakan as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ Carbon\carbon::parse($item->pendaftaran->tangal_daftar)->format('d-m-Y') }}</td>
                <td>{{ $item->no_rekamedis }}</td>
                <td>{{ $item->pasien->nama_pasien }}</td>
                <td>{{ $item->keluhan }}</td>
                <td>{{ $item->cek_fisik }}</td>
                <td>{{ $item->temperatur }}</td>
                <td>{{ $item->tekanan_darah }}</td>
                <td>{{ $item->tekanan_nadi }}</td>
                <td>{{ $item->hr }}</td>
                <td>{{ $item->rr }}</td>
                <td>{{ $item->tinggi_badan }}</td>
                <td>{{ $item->bb }}</td>
                <td>{{ $item->lp }}</td>
                <td>{{ $item->imt }}</td>
                <td>{{ $item->hasil_periksa }}</td>
                <td>{{ $item->jenis_kasus }}</td>
                <td>{{ $item->nama_tindakan }}</td>
                <td>{{ $item->rencana_pengobatan }}</td>
            </tr>
        @endforeach

    </tbody>
</table>
