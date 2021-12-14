<div class="card-body">
    <form
        @if ($pendaftaranId)
            wire:submit.prevent='updatePendaftaran({{ $pendaftaranId }})'
        @else
            wire:submit.prevent='savePendaftaran'
        @endif
    >

        <div class="row">
            <div class="col-lg-5">
                <h5>Data Pendaftaran</h5>

                <div class="form-group">
                    <label for="no_antrian">No Antrian</label>
                    <input wire:model.lazy='no_antrian' type="text" class="form-control" readonly>
                </div>

                <div class="form-group">
                    <label for="dokter">Dokter Penanggung Jawab</label>
                    <select wire:model.lazy='dokter' class="form-control @error('dokter') is-invalid @enderror" id="dokter">
                        <option selected>Pilih</option>
                         @foreach ($data_dokter as $item)
                            <option value="{{ $item->id }}">{{ $item->nama_dokter }}</option>
                         @endforeach
                    </select>
                    @error('dokter')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="poli">Poli Tujuan</label>
                    <select wire:model.lazy='poli' class="form-control @error('poli') is-invalid @enderror" id="poli">
                        <option selected>Pilih</option>
                         @foreach ($data_poli as $item)
                            <option value="{{ $item->id }}">{{ $item->nama_poli }}</option>
                         @endforeach
                    </select>
                    @error('poli')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-lg-7">
                <h5>Data Pasien</h5>


                <div class="form-group" wire:ignore>
                    <label for="pasien">Pasien</label>
                    <select  id="pasien" wire:model.lazy='pasien' class="form-control @error('pasien') is-invalid @enderror">
                        <option selected>Pilih</option>
                         @foreach ($data_pasien as $item)
                            <option value="{{ $item->id }}">{{ $item->kode_paramedis }} - {{ $item->nama_pasien }}</option>
                         @endforeach
                    </select>
                    @error('pasien')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="no_rekamedis">No Rekamedis</label>
                    <input wire:model.lazy='no_rekamedis' type="text" class="form-control" readonly>
                </div>

                <div class="form-group">
                    @if (!$showDataPasien)
                        <a href="#!" wire:click='openDetailPasien'>Lihat semua data</a>
                    @else
                        <a href="#!" wire:click='closeDetailPasien'>Tutup semua data</a>
                    @endif
                </div>

                @if ($showDataPasien)
                    <div class="form-group">
                        <label for="no_kk">No KK</label>
                        <input wire:model.lazy='no_kk' type="text" class="form-control" readonly>
                    </div>

                    <div class="form-group">
                        <label for="tanggal_lahir">Tanggal Lahir</label>
                        <input wire:model.lazy='tanggal_lahir' type="date" class="form-control" readonly>
                    </div>


                    <div class="form-group">
                        <label for="status_pasien">Status Pasien</label>
                        <input wire:model.lazy='status_pasien' type="text" class="form-control" readonly>
                    </div>

                    <div class="form-group">
                        <label for="no_jaminan">No Jaminan Kesehatan</label>
                        <input wire:model.lazy='no_jaminan' type="text" class="form-control" readonly>
                    </div>

                    <div class="form-group">
                        <label for="wilayah">Wilayah</label>
                        <input wire:model.lazy='wilayah' type="text" class="form-control" readonly>
                    </div>

                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea rows="3" wire:model.lazy='alamat' class="form-control" readonly></textarea>
                    </div>

                    <div class="form-group">
                        <label for="nama_penanggung_jawab">Nama Penanggung Jawab</label>
                        <input wire:model.lazy='nama_penanggung_jawab' type="text" class="form-control @error('nama_penanggung_jawaba') is-invalid @enderror"
                        placeholder="Masukkan nama penanggung jawab" disabled>
                        @error('nama_penanggung_jawab')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="hubungan">Hubungan</label>
                        <select wire:model.lazy='hubungan' class="form-control @error('hubungan') is-invalid @enderror" id="hubungan" disabled>
                            <option selected>Pilih</option>
                            <option value="anak">Anak</option>
                            <option value="orang tua">Orang Tua</option>
                            <option value="suami">Suami</option>
                            <option value="istri">Istri</option>
                            <option value="kakak">Kakak</option>
                            <option value="adik">Adik</option>
                            <option value="kakek">Kakek</option>
                            <option value="nenek">Nenek</option>
                            <option value="tetangga">Tetangga</option>
                            <option value="saudara">Saudara</option>
                            <option value="paman">Paman</option>
                            <option value="bibi">Bibi</option>
                            <option value="om">Om</option>
                            <option value="tante">Tante</option>
                            <option value="orang lain">Orang Lain</option>
                        </select>
                        @error('hubungan')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                @endif



            </div>
        </div>


        <div class="form-group" style="margin-top: 3% ;">
            @if ($pendaftaranId)
                <button class="btn btn-primary">Update</button>
                <button type="button" wire:click='closeFormCreatePendaftaran' class="btn btn-sm btn-primary" style="margin-left: 5px">X</button>
            @else
                <button class="btn btn-primary">Submit</button>
                <button type="button" wire:click='closeFormCreatePendaftaran' class="btn btn-sm btn-primary" style="margin-left: 5px">X</button>
            @endif
        </div>

    </form>
</div>

<script>
    $(document).ready(function() {
        $('#pasien').select2();

        $('#pasien').on('change', function() {
                @this.pasien = $(this).val();
         })
    });
</script>
