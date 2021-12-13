<table border='1' cellpadding="3">
	<thead>
		<tr>
			<th>No</th>
			<th>Nama Obat</th>
			<th>Sat</th>
			<th>Stock Awal</th>
			<th>Penerimaan</th>
			<th>Persediaan</th>
			<th colspan="3">Pengeluaran</th>
			<th>Stock Akhir</th>
			<th>Kebutuhan Perbulan (RKO)</th>
			<th>Stock OPT</th>
			<th>Permintaan</th>
			<th>Pemberian</th>
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
			<th>Pemakaian</th>
			<th>ED/Rusak</th>
			<th>Recal</th>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td></td>
			<td>A. OBAT-OBATAN</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td></td>
			<td>1. Sediaan Obat TAPKAPSUL</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		 @foreach ($lplpo as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->obat->nama_obat }} {{ $item->obat->sediaan }}</td>
                <td>{{ $item->obat->satuan }}</td>
                <td>{{ $item->stock->stock_awal }}</td>
                <td>{{ $item->penerimaan }}</td>
                <td>{{ $item->persediaan }}</td>
                <!-- Pengeluaran -->

                <td>{{ $item->pemakaian }}</td>
                <td>{{ $item->rusak }}</td>
                <td>{{ $item->recal }}</td>


                <!-- end Pengeluaran -->
                <td>{{ $item->stock_akhir }}</td>
                <td>{{ $item->rko }}</td>
                <td>{{ $item->stock_opt }}</td>
                <td>{{ $item->permintaan }}</td>
                <td>{{ $item->pemberian }}</td>
                <td>{{ $item->keterangan }}</td>
            </tr>
         @endforeach
	</tbody>
</table>