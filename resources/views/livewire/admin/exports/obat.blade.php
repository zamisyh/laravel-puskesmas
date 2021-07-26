<table class="table table-bordered table-striped table-hover">
    <thead>
        <tr>
            <th>No</th>
            <th>Kode</th>
            <th>Nama</th>    
            <th>Jenis</th>
            <th>Dosis</th>
            <th>Satuan</th>
            <th>Sediaan</th>
        </tr>   
    </thead>
    <tbody>
        @forelse ($obats as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->kode_obat }}</td>
                <td>{{ $item->nama_obat }}</td>    
                <td>{{ $item->jenis_obat }}</td>
                <td>{{ $item->dosis_aturan_obat }}</td>
                <td>{{ $item->satuan }}</td>
                <td>{{ $item->sediaan }}</td>
            </tr>   
        @empty
        <td colspan="8" class="text-center">Data not found</td>
        @endforelse
    </tbody>
</table>