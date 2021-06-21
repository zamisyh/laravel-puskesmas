<div>

    @section('title', 'Tindakan - Penanganan Operasi')

    <div id="app">
        @include('livewire.admin.components.sidebar')
        <div id="main" class='layout-navbar'>
            @include('livewire.admin.components.header')
            <div id="main-content">

                <div class="page-heading">
                    <div class="page-title">
                        <div class="row">
                            <div class="col-12 col-md-6 order-md-1 order-last">
                                <h3>Tindakan - Penanganan Operasi</h3>
                                <p class="text-subtitle text-muted">Hi, this is page for manajement data Penanganan Operasi</p>
                            </div>
                            <div class="col-12 col-md-6 order-md-2 order-first">
                                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{ route('dash.home') }}">Dashboard</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Tindakan
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">Penanganan Operasi
                                        </li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <section class="section">
                        <div class="card">
                        
                            @if ($openFormCreate)
                            <div class="card-header d-flex justify-content-between">
                                <h4>Create Penanganan Operasi</h4>

                                <div>
                                    <button type="button" wire:click='closeFormCreatePenangananOperasi' class="btn btn-sm btn-primary" style="margin-left: 5px">X</button>
                                </div>
                            </div>
                            <div class="card-body">
                                <form
                                    @if ($penangananOperasiId)
                                        wire:submit.prevent='updatePenangananOperasi({{ $penangananOperasiId }})'
                                    @else
                                        wire:submit.prevent='savePenangananOperasi'
                                    @endif
                                >

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

                                   @if (!is_null($pasien))
                                    <div class="form-group">
                                        <label for="status_pasien">Status Pasien</label>
                                        <select wire:model.lazy='status_pasien' class="form-control @error('status_pasien') is-invalid @enderror" id="status_pasien">
                                            <option>Pilih</option>
                                            <option value="bpjs">BPJS</option>
                                            <option value="umum">Umum</option>
                                            
                                        </select>
                                        @error('status_pasien')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                   @endif

                                   @if ($formBpjs)
                                    <div class="form-group">
                                        <label for="no_bpjs">No BPJS</label>
                                        <input type="text" wire:model.lazy='no_bpjs' class="form-control @error('np_bpjs')
                                            is-invalid
                                        @enderror" placeholder="Masukkan no bpjs">
                                        @error('no_bpjs')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                   @endif

                                <div class="form-group">
                                    <label for="nama_operasi">Nama Operasi</label>
                                    <input type="text" wire:model.lazy='nama_operasi' class="form-control @error('nama_operasi')
                                        is-invalid
                                    @enderror" placeholder="Masukkan nama operasi">
                                    @error('nama_operasi')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="biaya">Biaya</label>
                                    <input type="number" wire:model.lazy='biaya' class="form-control @error('biaya')
                                        is-invalid
                                    @enderror" placeholder="Masukkan nominal biaya" {{ $freeBpjs ? 'readonly' : '' }} >
                                    @error('biaya')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="ditangani_oleh">Ditangani Oleh</label>
                                    <select wire:model.lazy='ditangani_oleh' class="form-control @error('ditangani_oleh') is-invalid @enderror" id="ditangani_oleh">
                                        <option>Pilih</option>
                                        <option value="dokter">Dokter</option>
                                        <option value="petugas">Petugas</option>
                                        <option value="dokter dan petugas">Dokter Dan Petugas</option>
                                        
                                    </select>
                                    @error('ditangani_oleh')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="dibayar">Dibayar</label>
                                    <input type="number" wire:model.lazy='dibayar' class="form-control @error('dibayar')
                                        is-invalid
                                    @enderror" placeholder="Masukkan nominal pembayaaran" {{ $freeBpjs ? 'readonly' : '' }} >
                                    @error('dibayar')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="kembalian">Kembalian</label>
                                    <input type="number" wire:model.lazy='kembalian' class="form-control @error('kembalian')
                                        is-invalid
                                    @enderror" placeholder="Klik untuk melihat kembalian" readonly>
                                    @error('kembalian')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="keterangan">Keterangan</label>
                                    <textarea rows="4" wire:model.lazy='keterangan' class="form-control @error('keterangan')
                                        is-invalid
                                    @enderror" placeholder="Masukkan keterangan" {{ $freeBpjs ? 'readonly' : '' }}> </textarea>
                                    @error('keterangan')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="tanggal_operasi">Tanggal Operasi</label>
                                    <input type="date" wire:model.lazy='tanggal_operasi' class="form-control @error('tanggal_operasi')
                                        is-invalid
                                    @enderror">
                                    @error('tanggal_operasi')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>


                                   

                                    


                                    <div class="form-group" style="margin-top: 3% ;">
                                        @if ($penangananOperasiId)
                                            <button class="btn btn-primary">Update</button>
                                        @else
                                            <button class="btn btn-primary">Submit</button>
                                        @endif
                                    </div>

                                </form>
                            </div>

                            @else

                                <div class="card-header">
                                    <div class="d-flex justify-content-between">
                                        <h4>Data Penanganan Operasi</h4>
                                        <div>
                                            <button wire:click='openFormCreatePenangananOperasi' class="btn btn-sm btn-primary">Tambah Data</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">

                                    <div>
                                        <input type="text" wire:model='search' placeholder="Search by nama, status">
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
                                                    <th>Nama Pasien</th>
                                                    <th>Status</th>
                                                    <th>Nama Operasi</th>
                                                    <th>Biaya</th>
                                                    @if ($details)
                                                        <th>Ditangani Oleh</th>
                                                        <th>Tanggal Operasi</th>
                                                    @endif
                                                    <th>Actions</th>
                                                </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($penanganan_operasi as $key => $item)
                                                <tr>
                                                    <td>{{ $penanganan_operasi->firstItem() + $key }}</td>
                                                    <td>{{ $item->pasien->nama_pasien }}</td>
                                                    <td>{{ strtoupper($item->status_pasien) }}</td>
                                                    <td>{{ $item->nama_operasi }}</td>
                                                    <td>Rp. {{ number_format($item->biaya) }}</td>
                                                    @if ($details)
                                                        <td>{{ ucwords(strtolower($item->ditangani_oleh)) }}</td>
                                                        <td>{{ Carbon\carbon::parse($item->tanggal_operasi)->format('d M Y') }}</td>
                                                    @endif
                                                    <td class="d-flex">
                                                        <button wire:click="openFormUpdatePenangananOperasi({{ $item->id }})" class="btn btn-primary btn-sm">
                                                            <i class="bi bi-pencil-square"></i>
                                                        </button>
                                                        <button wire:click.prevent='deletePenangananOperasi({{ $item->id }})' style="margin-left: 5px" class="btn btn-danger btn-sm">
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
                                        {{ $penanganan_operasi->links() }}
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
