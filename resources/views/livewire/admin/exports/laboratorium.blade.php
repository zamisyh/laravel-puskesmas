<table class="table table-bordered table-striped table-hover">
    <thead>
            <tr>
                <th>No</th>
                <th>No Lab</th>
                <th>Nama</th>
                <th>Umur</th>
                <th>Alamat</th>
                <th>No. RM</th>
                <th>Jaminan Kesehatan</th>
                <th>Dokter Pengirim</th>
                <th>Asal Poli</th>
                <th>Tanggal</th>
            </tr>
    </thead>
    <tbody>
        @forelse ($labs as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->no_rawat }}</td>
                <td>{{ $item->pendaftaran->pasien->nama_pasien }}</td>
                <td>{{ $item->pendaftaran->pasien->usia }}</td>
                <td>{{ $item->pendaftaran->pasien->alamat }}</td>
                <td>{{ $item->no_rekammedis }}</td>
                <td>{{ $item->pendaftaran->status_pasien }}</td>
                <td>{{ $item->pendaftaran->dokter->nama_dokter }}</td>
                <td>{{ $item->pendaftaran->poli->nama_poli }}</td>
                <td>{{ $item->created_at }}</td>
            </tr>

            @empty

            <td colspan="10" class="text-center">Data not found</td>
        @endforelse
    </tbody>
    </table>