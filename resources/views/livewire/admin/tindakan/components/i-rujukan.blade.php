<div class="card">
    <div class="card-header">
        <h4>Input Rujukan</h4>
    </div>
    <div class="card-body">
        <form wire:submit.prevent='saveRujukan'>
            <div class="form-group">
                <label for="nama_pasien">Nama Pasien</label>
                <input type="text" wire:model='nama_pasien' class="form-control @error('nama_pasien')
                    is-invalid
                @enderror" readonly>
            </div>
            <div class="form-group">
                <label for="diagnosa">Diagnosa</label>
                <input type="hidden" wire:model='nama_diagnosa' class="form-control @error('nama_diagnosa')
                    is-invalid
                @enderror" readonly>
    
                <p>{{ $nama_diagnosa }}</p>
            </div>
    
            <div class="form-group">
                <label for="nama_rumah_sakit">Nama Rumah Sakit</label>
                <input type="text" wire:model='nama_rumah_sakit' class="form-control @error('nama_rumah_sakit')
                    is-invalid
                @enderror">
            </div>
    
            <div class="form-group">
                <label for="poli_rujukan_tujuan">Poli Tujuan</label>
                <input type="text" wire:model='poli_rujukan_tujuan' class="form-control @error('poli_rujukan_tujuan')
                    is-invalid
                @enderror">
            </div>

            <button class="btn btn-success">Submit</button>
        </form>
    </div> 
</div>