<div class="card">
    <div class="card-header">
        <h4>Input Tindakan</h4>
    </div>
    <div class="card-body">
        <form wire:submit.prevent='saveTindakan'>
            <div class="form-group">
                <label for="poli_tujuan">Poli Tujuan</label>
                <input type="text" wire:model.lazy='poli_tujuan' class="form-control @error('poli_tujuan')
                    is-invalid
                @enderror" readonly>
            </div>
    
            <div class="form-group">
                <label for="keluhan">Keluhan</label>
                <input type="text" wire:model.lazy='keluhan' class="form-control @error('keluhan')
                    is-invalid
                @enderror" placeholder="Masukkan keluhan">
                @error('keluhan')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
    
            <div class="form-group">
                <label for="pemeriksaan_fisik">Pemeriksaan Fisik</label>
                <input type="text" wire:model.lazy='pemeriksaan_fisik' class="form-control @error('pemeriksaan_fisik')
                    is-invalid
                @enderror" placeholder="Masukkan pemeriksaan fisik">
                @error('pemeriksaan_fisik')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
    
    
            <div class="form-group">
                <label for="temperatur">Temperatur</label>
                <input type="number" wire:model.lazy='temperatur' class="form-control @error('temperatur')
                    is-invalid
                @enderror" placeholder="Masukkan temperatur">
                @error('temperatur')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
    
            <div class="form-group">
                <label for="tinggi_badan">Tinggi Badan</label>
                <input type="number" wire:model.lazy='tinggi_badan' class="form-control @error('tinggi_badan')
                    is-invalid
                @enderror" placeholder="Masukkan tinggi badan">
                @error('tinggi_badan')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
    
            <div class="form-group">
                <label for="tekanan_nadi">Tekanan Nadi</label>
                <input type="text" wire:model.lazy='tekanan_nadi' class="form-control @error('tekanan_nadi')
                    is-invalid
                @enderror" placeholder="Masukkan tekanan nadi">
                @error('tekanan_nadi')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="tekanan_darah">Tekanan Darah</label>
                <input type="text" wire:model.lazy='tekanan_darah' class="form-control @error('tekanan_darah')
                    is-invalid
                @enderror" placeholder="Masukkan tekanan darah">
                @error('tekanan_darah')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
    
            <div class="form-group">
                <label for="hr">HR</label>
                <input type="text" wire:model.lazy='hr' class="form-control @error('hr')
                    is-invalid
                @enderror" placeholder="Masukkan hr">
                @error('hr')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
    
            <div class="form-group">
                <label for="rr">RR</label>
                <input type="text" wire:model.lazy='rr' class="form-control @error('rr')
                    is-invalid
                @enderror" placeholder="Masukkan rr">
                @error('rr')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
    
            <div class="form-group">
                <label for="bb">BB</label>
                <input type="text" wire:model.lazy='bb' class="form-control @error('bb')
                    is-invalid
                @enderror" placeholder="Masukkan bb">
                @error('bb')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
    
            <div class="form-group">
                <label for="lp">LP</label>
                <input type="text" wire:model.lazy='lp' class="form-control @error('lp')
                    is-invalid
                @enderror" placeholder="Masukkan lp">
                @error('lp')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
    
            <div class="form-group">
                <label for="pemeriksaan_penunjang">Pemeriksa Penunjang</label>
                <input type="text" wire:model.lazy='pemeriksaan_penunjang' class="form-control @error('pemeriksaan_penunjang')
                    is-invalid
                @enderror" placeholder="Masukkan pemeriksa penunjang">
                @error('pemeriksaan_penunjang')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
    
            <div class="form-group">
                <label for="diagnosa">Diagnosa</label>
                <select wire:model.lazy='diagnosa' class="form-control @error('diagnosa')
                    is-invalid
                @enderror">
                    <option value="" selected>Pilih</option>
                    @foreach ($data_diagnosa as $diagnosa)
                        <option value="{{ $diagnosa->id }}">[ {{ $diagnosa->code }} ] {{ $diagnosa->nama_penyakit }}</option>
                    @endforeach
                </select>
                @error('diagnosa')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
    
            <div class="form-group">
                <label for="tindakan">Tindakan</label>
                <select wire:model.lazy='nama_tindakan' class="form-control @error('nama_tindakan')
                    is-invalid
                @enderror">
                    <option value="" selected>Pilih</option>
                    @foreach ($data_tindakan as $tindakan)
                        <option value="{{ $tindakan->id }}">{{ $tindakan->nama_tindakan }}</option>
                    @endforeach
                </select>
                @error('nama_tindakan')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="hasil_periksa">Hasil Periksa</label>
                <input type="text" wire:model.lazy='hasil_periksa' class="form-control @error('hasil_periksa')
                    is-invalid
                @enderror" placeholder="Masukkan hasil periksa">
                @error('hasil_periksa')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
    
            <div class="form-group">
                <label for="rencana_pengobatan">Rencana Pengobatan</label>
                <input type="text" wire:model.lazy='rencana_pengobatan' class="form-control @error('rencana_pengobatan')
                    is-invalid
                @enderror" placeholder="Masukkan rencana pengobatan">
                @error('rencana_pengobatan')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
    
            <div class="form-group">
                <button class="btn btn-success">Submit</button>
            </div>
        </form>

    </div> 
</div>
