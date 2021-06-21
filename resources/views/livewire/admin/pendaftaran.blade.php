<div>

    @section('title', 'Pendaftaran')

    <div id="app">
        @include('livewire.admin.components.sidebar')
        <div id="main" class='layout-navbar'>
            @include('livewire.admin.components.header')
            <div id="main-content">

                <div class="page-heading">
                    <div class="page-title">
                        <div class="row">
                            <div class="col-12 col-md-6 order-md-1 order-last">
                                <h3>Pendaftaran</h3>
                                <p class="text-subtitle text-muted">Hi, this is page for manajement data Pendaftaran</p>
                            </div>
                            <div class="col-12 col-md-6 order-md-2 order-first">
                                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{ route('dash.home') }}">Dashboard</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Pendaftaran
                                        </li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <section class="section">
                        <div class="card">
                            @if ($openFormCreate)
                            
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
                                                <label for="no_rawat">No Rawat</label>
                                                <input wire:model.lazy='no_rawat' type="text" class="form-control" readonly>
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
                                            
                                    
                                            <div class="form-group">
                                                <label for="pasien">Pasien</label>
                                                <select wire:model.lazy='pasien' class="form-control @error('pasien') is-invalid @enderror" id="pasien">
                                                    <option selected>Pilih</option>
                                                     @foreach ($data_pasien as $item)
                                                        <option value="{{ $item->id }}">{{ $item->nama_pasien }}</option>
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
                                                    <label for="no_jaminan">No Jaminan</label>
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
                                            @endif

                                            <div class="form-group">
                                                <label for="nama_penanggung_jawab">Nama Penanggung Jawab</label>
                                                <input wire:model.lazy='nama_penanggung_jawab' type="text" class="form-control @error('nama_penanggung_jawaba') is-invalid @enderror"
                                                placeholder="Masukkan nama penanggung jawab">
                                                @error('nama_penanggung_jawab')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>  

                                            <div class="form-group">
                                                <label for="hubungan">Hubungan</label>
                                                <select wire:model.lazy='hubungan' class="form-control @error('hubungan') is-invalid @enderror" id="hubungan">
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

                                            <div class="form-group">
                                                <label for="alamat_penanggung_jawab">Alamat Penanggung Jawab</label>
                                                <textarea rows="4" wire:model.lazy='alamat_penanggung_jawab' class="form-control @error('alamat_penanggung_jawab') is-invalid @enderror" placeholder="Masukkan alamat"></textarea>
                                              
                                                @error('alamat_penanggung_jawab')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>  
                                            
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

                            @else

                                <div class="card-header">
                                    <div class="d-flex justify-content-between">
                                        <h4>Data Pendaftaran</h4>
                                        <div>
                                            <button wire:click='openFormCreatePendaftaran' class="btn btn-sm btn-primary">Tambah Data</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">

                                    <div>
                                        <input type="text" wire:model='search' placeholder="Search by no, rekamedis, nama">
                                        <select wire:model='rows'>
                                            <option value="5" selected>5</option>
                                            <option value="10" selected>10</option>
                                            <option value="15" selected>15</option>
                                            <option value="20" selected>20</option>
                                        </select>

                                        @if (!$details)
                                                <button wire:click='openDetails' class="btn btn-primary btn-sm">
                                                    <i class="bi bi-eye-slash-fill"></i>
                                                </button>

                                            @else
                                                <button wire:click='closeDetails' class="btn btn-primary btn-sm">
                                                    <i class="bi bi-eye-fill"></i>
                                                </button>
                                        @endif

                                    </div>

                                    <p></p>

                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped table-hover">
                                        <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>No Rawat</th>
                                                    <th>No Rekamedis</th>
                                                    <th>Nama Pasien</th>
                                                    <th>Status</th>
                                                    @if ($details)
                                                        <th>Nama Dokter</th>
                                                        <th>Jenis Poli</th>
                                                    @endif
                                                    <th>Actions</th>
                                                </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($pendaftarans as $key => $item)
                                                <tr>
                                                    <td>{{ $pendaftarans->firstItem() + $key }}</td>
                                                    <td>{{ $item->no_rawat }}</td>
                                                    <td>{{ $item->no_rekammedis }}</td>
                                                    <td>{{ $item->pasien->nama_pasien }}</td>
                                                    <td>{{ $item->status_pasien }}</td>
                                                    @if ($details)
                                                        <td>{{ $item->dokter->nama_dokter }}</td>
                                                        <td>{{ $item->poli->nama_poli }}</td>
                                                    @endif
                                                    <td class="d-flex">
                                                        <button wire:click="openFormUpdatePendaftaran({{ $item->id }})" class="btn btn-primary btn-sm">
                                                            <i class="bi bi-pencil-square"></i>
                                                        </button>
                                                        <button wire:click.prevent='deletePendaftaran({{ $item->id }})' style="margin-left: 5px" class="btn btn-danger btn-sm">
                                                            <i class="bi bi-trash-fill"></i>
                                                        </button>
                                                    </td>
                                                </tr>

                                                @empty

                                                <td colspan="10" class="text-center">Data not found</td>
                                            @endforelse
                                        </tbody>
                                        </table>
                                    </div>

                                    <div>
                                        {{ $pendaftarans->links() }}
                                    </div>
                                </div>

                            @endif
                        </div>
                    </section>
                </div>

                @include('livewire.admin.components.footer')

            </div>
        </div>
    </div>

    @section('js')
        <script src="{{  asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
        <script src="{{  asset('assets/js/bootstrap.bundle.min.js') }}"></script>

        <script src="{{  asset('assets/js/main.js') }}"></script>
    @endsection
</div>
