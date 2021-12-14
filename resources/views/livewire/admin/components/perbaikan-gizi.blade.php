<form
@if ($perbaikanGiziId)
    wire:submit.prevent='updatePerbaikanGizi({{ $perbaikanGiziId }})'
@else
    wire:submit.prevent='savePerbaikanGizi'
@endif
>


<div class="form-group" wire:ignore>
    <label for="nama_pasien">Nama Pasien</label>
    <select  id="nama_pasien" wire:model='nama_pasien' class="form-control @error('nama_pasien')
        is-invalid
    @enderror">
    <option value="" selected>Pilih</option>
    @foreach ($data_pasien as $item)
        <option value="{{ $item->id }}">{{ $item->kode_paramedis }} - {{ $item->nama_pasien }}</option>
    @endforeach
</select>
</div>

<div class="form-group">
    <label for="hasil">Hasil</label>
    <input type="number" wire:model.lazy='hasil' class="form-control @error('hasil') is-invalid @enderror" placeholder="Masukkan hasil">
    @error('hasil')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<div class="form-group">
    <label for="terapi">Terapi</label>
    <textarea rows="4" wire:model.lazy='terapi' class="form-control @error('terapi') is-invalid @enderror" placeholder="Masukkan terapi"></textarea>
    @error('terapi')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<div class="form-group">
    <label for="tanggal">Tanggal</label>
    <input type="date" wire:model.lazy='tanggal' class="form-control @error('tanggal') is-invalid @enderror" placeholder="Masukkan tanggal">
    @error('tanggal')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>





@if ($perbaikanGiziId)
    <button class="btn btn-primary">Update</button>
@else
    <button class="btn btn-primary">Submit</button>
@endif

</form>

<script>
    $(document).ready(function() {
        $('#nama_pasien').select2();

        $('#nama_pasien').on('change', function() {
                @this.nama_pasien = $(this).val();
         })
    });
</script>
