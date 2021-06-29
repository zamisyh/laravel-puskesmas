<div class="card">
    <div class="card-header">
        <h4>Input Resep Obat</h4>
    </div>
    <div class="card-body">
        <form wire:submit.prevent='saveResepObat'>
            <div class="form-group" wire:ignore>
                <label for="nama_obat">Nama Obat</label>
                <select wire:model.lazy='nama_obat' class="form-control @error('nama_obat')
                        is-invalid
                    @enderror" id="nama_obat">
                    <option value="" selected>Pilih</option>
                    @foreach ($data_obat as $item)
                        <option value="{{ $item->obat->id }}">{{ $item->obat->nama_obat }}</option>
                    @endforeach
                </select>
                @error('nama_obat')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="kode_obat">Kode Obat</label>
                <input type="text" wire:model.lazy='kode_obat' class="form-control" readonly>
            </div>
            <div class="form-group">
                <label for="jenis_obat">Jenis Obat</label>
                <input type="text" wire:model.lazy='jenis_obat' class="form-control @error('jenis_obat')
                    is-invalid
                @enderror" placeholder="Masukkan jenis obat">
                @error('jenis_obat')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="dosis">Dosis Obat Dan Aturan</label>
                <input type="text" wire:model.lazy='dosis' class="form-control @error('dosis')
                    is-invalid
                @enderror" placeholder="Masukkan dosis dan aturan">
                @error('dosis')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="stock_obat">Stock Obat</label>
                <input type="text" wire:model.lazy='stock_obat' class="form-control" readonly>
            </div>
            
            <div class="form-group">
                <label for="jumlah_obat">Jumlah</label>
                <input type="text" wire:model.lazy='jumlah_obat' class="form-control @error('jumlah_obat')
                    is-invalid
                @enderror" placeholder="Masukkan jumlah obat">
                @error('jumlah_obat')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                @if ($stock_obat && $stock_obat > 1)
                    <button class="btn btn-success">Submit</button>
                @else
                    <button class="btn btn-danger" disabled>Submit</button>
                @endif
            </div>
        </form>
    </div> 
</div>

<script>
    $(document).ready(function() {
        $('#nama_obat').select2();

        $('#nama_obat').on('change', function() {
                @this.nama_obat = $(this).val();
         })
    });
</script>