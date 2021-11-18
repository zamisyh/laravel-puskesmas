<table border="1" cellpadding='5'>
    <thead>
        <tr>
            <th>No</th>
            <th>No Antrian</th>
            <th>No RM</th>
            <th>Jaminan</th>
            <th>No Jaminan</th>
            <th>Nama Pasien</th>
            <th>Nama KK</th>
            <th colspan="2">Usia</th>
            <th>Tanggal Lahir</th>
            <th>Alamat</th>
            <th>DW</th>
            <th>LW</th>
            <th>Ket</th>

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
			<td></td>
        </tr>
        @foreach ($pasien as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->no_antrian }}</td>
                <td>{{ $item->kode_paramedis }}</td>
                <td>{{ $item->jaminan->nama_jaminan }}</td>
                <td>{{ $item->no_jaminan }}</td>
                <td>{{ $item->nama_pasien }}</td>
                <td>{{ $item->nama_kk }}</td>
                @if ($item->jenis_kelamin == 'L')
                    <td>{{ $item->usia }}</td>
                    <td></td>
                @else
                    <td></td>
                    <td>{{ $item->usia }}</td>
                @endif
                <td>{{ $item->tanggal_lahir }}</td>
                <td>{{ $item->alamat }}</td>
                @if ($item->wilayah == 'Dalam Wilayah')
                    <td>&#10004;</td>
                    <td></td>
                @else
                    <td></td>
                    <td>&#10004;</td>
                @endif
                <td>{{ $item->keterangan }}</td>


            </tr>
        @endforeach
    </tbody>
</table>
