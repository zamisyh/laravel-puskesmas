<table border="1" cellpadding='5'>
    <thead>
        <tr>
            <th>No</th>
            <th>No Rawat</th>
            <th>No RM</th>
            <th>Tanggal Daftar</th>
            <th>Nama Pasien</th>
            <th>Nama KK</th>
            <th>Tanggal Lahir</th>
            <th colspan="2">Usia</th>
            <th>Nama Dokter</th>
            <th>Poli Tujuan</th>
            <th>Status Pasien</th>
            <th>No Jaminan Kesehatan</th>
            
        </tr>
    </thead>
    <tbody>
        <tr>
            <td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
            <td></td>
            <td></td>
            <td>L</td>
			<td>P</td>
			<td></td>
			<td></td>
        </tr>
        @foreach ($pendaftaran as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->no_rawat }}</td>
                <td>{{ $item->no_rekammedis }}</td>
                <td>{{ $item->tanggal_daftar }}</td>
                <td>{{ $item->pasien->nama_pasien }}</td>
                <td>{{ $item->pasien->nama_kk }}</td>
                <td>{{ $item->pasien->tanggal_lahir }}</td>
                @if ($item->pasien->jenis_kelamin == 'L')
                    <td>{{ $item->pasien->usia }}</td>
                    <td></td>
                @else
                    <td></td>
                    <td>{{ $item->pasien->usia }}</td>
                @endif
                <td>{{ $item->dokter->nama_dokter }}</td>
                <td>{{ $item->poli->nama_poli }}</td>
                <td>{{ $item->status_pasien }}</td>
                <td>{{ $item->no_jaminan }}</td>
                    
               
            </tr>
        @endforeach
    </tbody>
</table>