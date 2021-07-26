<table border="1">
    <thead>
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Jenis Kelamin</th>    
        <th>Nomor Induk Dokter</th>
        <th>Poli</th>
        <th>TTL</th>
        <th>Alamat</th>
    </tr>
    </thead>
    <tbody>
    @foreach($dokters as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->nama_dokter }}</td>
            <td>{{ $item->jenis_kelamin }}</td>    
            <td>{{ $item->nid }}</td>
            <td>{{ $item->poli->nama_poli }}</td>
            <td>
                {{ ucwords(strtolower($item->tempat_lahir)) }},
                {{ Carbon\carbon::parse($item->tanggal_lahir)->format('d M Y') }}
            </td>
            <td>{{ $item->alamat }}</td>
              
        </tr>
    @endforeach
    </tbody>
</table>
