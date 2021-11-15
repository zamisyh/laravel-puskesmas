<div class="form-group" wire:ignore>
        <label for="cari_rekammedis">Cari Rekammedis</label>
        <select id="cari_rekammedis" wire:model.lazy='cari_rekammedis' class="form-control @error('cari_rekammedis') is-invalid @enderror">
            <option selected value="kosong">Pilih</option>
            @foreach ($data_rekammedis as $item)
                <option value="{{ $item->kode_paramedis }}">{{ $item->kode_paramedis }} - {{  $item->nama_kk  }}</option>
            @endforeach
        </select>
        @error('cari_rekammedis')
            <span class="text-danger">{{ $message }}</span>
        @enderror
</div>
<script>
    $(document).ready(function() {
        $('#cari_rekammedis').select2();

        $('#cari_rekammedis').on('change', function() {
                @this.cari_rekammedis = $(this).val();
         })
    });
</script>
