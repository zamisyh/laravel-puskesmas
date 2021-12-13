<div>

    @section('title', 'Master Data - Jadwal Praktek Dokter')

    <div id="app">
        @include('livewire.admin.components.sidebar')
        <div id="main" class='layout-navbar'>
            @include('livewire.admin.components.header')
            <div id="main-content">

                <div class="page-heading">
                    <div class="page-title">
                        <div class="row">
                            <div class="col-12 col-md-6 order-md-1 order-last">
                                <h3>Master Data - Jadwal Praktek Dokter</h3>
                                <p class="text-subtitle text-muted">Hi, this is page for manajement data Jadwal Praktek Dokter</p>
                            </div>
                            <div class="col-12 col-md-6 order-md-2 order-first">
                                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{ route('dash.home') }}">Dashboard</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Master Data
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">Jadwal Praktek Dokter
                                        </li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <section class="section">
                        <div class="card">
                            @if ($openFormCreate)
                                <div class="card-header">
                                    <div class="d-flex justify-content-between">
                                        <h4>Create Jadwal Praktek Dokter</h4>
                                        <div>
                                            <button wire:click='closeFormCreateJadwalPraktekDokter' class="btn btn-sm btn-primary">X</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <form
                                        @if ($jadwalPraktekDokterId)
                                            wire:submit.prevent='updateJadwalPraktekDokter({{ $jadwalPraktekDokterId }})'
                                        @else
                                            wire:submit.prevent='saveJadwalPraktekDokter'
                                        @endif
                                    >
                                        
                                        <div class="form-group">
                                            <label for="dokter">Nama Dokter</label>
                                            <select wire:model.lazy='dokter' class="form-control @error('dokter') is-invalid @enderror">
                                                <option selected>Pilih</option>
                                                @foreach ($data_dokter as $dokter)
                                                    <option value="{{ $dokter->id }}">{{ $dokter->nama_dokter }}</option>
                                                @endforeach
                                            </select>
                                            @error('dokter')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="hari">Hari</label>
                                            <select wire:model.lazy='hari' class="form-control @error('hari') is-invalid @enderror">
                                                <option selected>Pilih</option>
                                                <option value="senin">Senin</option>
                                                <option value="selasa">Selasa</option>
                                                <option value="rabu">Rabu</option>
                                                <option value="kamis">Kamis</option>
                                                <option value="jumat">Jumat</option>
                                                <option value="sabtu">Sabtu</option>
                                            </select>
                                            @error('hari')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="jam_mulai">Jam Mulai</label>
                                            <input type="time" wire:model.lazy='jam_mulai' class="form-control @error('jam_mulai') is-invalid @enderror" placeholder="Masukkan jam mulai">
                                            @error('jam_mulai')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="jam_selesai">Jam Selesai</label>
                                            <input type="time" wire:model.lazy='jam_selesai' class="form-control @error('jam_selesai') is-invalid @enderror" placeholder="Masukkan jam mulai">
                                            @error('jam_selesai')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="poli">Poli</label>
                                            <select wire:model.lazy='poli' class="form-control @error('poli') is-invalid @enderror">
                                                <option selected>Pilih</option>
                                                @foreach ($data_poli as $poli)
                                                    <option value="{{ $poli->id }}">{{ $poli->nama_poli }}</option>
                                                @endforeach
                                            </select>
                                            @error('poli')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        
                                    

                                        @if ($jadwalPraktekDokterId)
                                            <button class="btn btn-primary">Update</button>
                                        @else
                                            <button class="btn btn-primary">Submit</button>
                                        @endif

                                    </form>
                                </div>

                            @else

                                <div class="card-header">
                                    <div class="d-flex justify-content-between">
                                        <h4>Data Jadwal Praktek Dokter</h4>
                                        <div>
                                            <button wire:click='openFormCreateJadwalPraktekDokter' class="btn btn-sm btn-primary">Tambah Data</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">

                                    <div>
                                        <input type="text" wire:model='search' placeholder="Search by nama, hari">
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
                                                <th>Nama</th>
                                                <th>Hari</th>    
                                                <th>Jam Mulai</th>
                                                <th>Jam Selesai</th>
                                                <th>Poli</th>
                                                @if ($details)
                                                    <th>Nomor Induk Dokter</th>
                                                    <th>Kode Dokter</th>
                                                @endif
                                                <th>Actions</th>
                                            </tr>   
                                        </thead>
                                        <tbody>
                                            @forelse ($jadwalPraktekDokters as $key => $item)
                                                <tr>
                                                    <td>{{ $jadwalPraktekDokters->firstItem() + $key }}</td>
                                                    <td>{{ $item->dokter->nama_dokter }}</td>
                                                    <td>{{ ucwords($item->hari) }}</td>    
                                                    <td>{{ Carbon\carbon::parse($item->jam_mulai)->format('h:i A') }}</td>
                                                    <td>{{ Carbon\carbon::parse($item->jam_selesai)->format('h:i A') }}</td>
                                                    <td>{{ $item->poli->nama_poli }}</td>
                                                    @if ($details)
                                                        <td>{{ $item->dokter->nid }}</td>
                                                        <td>{{ $item->dokter->kode_dokter }}</td>
                                                    @endif
                                                    <td class="d-flex">
                                                        <button wire:click="openFormUpdateJadwalPraktekDokter({{ $item->id }})" class="btn btn-primary btn-sm">
                                                            <i class="bi bi-pencil-square"></i>
                                                        </button>
                                                        <button wire:click.prevent='deleteJadwalPraktekDokter({{ $item->id }})' style="margin-left: 5px" class="btn btn-danger btn-sm">
                                                            <i class="bi bi-trash-fill"></i>
                                                        </button>
                                                    </td>
                                                </tr>   
                                            @empty
                                            <td colspan="8" class="text-center">Data not found</td>
                                            @endforelse
                                        </tbody>
                                        </table>
                                    </div>

                                    <div>
                                        {{ $jadwalPraktekDokters->links() }}
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
