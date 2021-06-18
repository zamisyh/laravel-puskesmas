<div>

    @section('title', 'Master Data - Pasien')

    <div id="app">
        @include('livewire.admin.components.sidebar')
        <div id="main" class='layout-navbar'>
            @include('livewire.admin.components.header')
            <div id="main-content">

                <div class="page-heading">
                    <div class="page-title">
                        <div class="row">
                            <div class="col-12 col-md-6 order-md-1 order-last">
                                <h3>Master Data - Pasien</h3>
                                <p class="text-subtitle text-muted">Hi, this is page for manajement data Pasien</p>
                            </div>
                            <div class="col-12 col-md-6 order-md-2 order-first">
                                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{ route('dash.home') }}">Dashboard</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Master Data
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">Pasien
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
                                        <h4>Create Pasien</h4>
                                        <div>
                                            <button wire:click='closeFormCreatePasien' class="btn btn-sm btn-primary">X</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <form
                                        @if ($pasienId)
                                            wire:submit.prevent='updatePasien({{ $pasienId }})'
                                        @else
                                            wire:submit.prevent='savePasien'
                                        @endif
                                    >
                                        <div class="form-group">
                                            <label for="no_rekamedis">No Rekamedis</label>
                                            <input type="text" wire:model.lazy='no_rekamedis' class="form-control @error('no_rekamedis') is-invalid @enderror" placeholder="Masukkan No Rekamedis">
                                            @error('no_rekamedis')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="nama_pasien">Nama Pasien</label>
                                            <input type="text" wire:model.lazy='nama_pasien' class="form-control @error('nama_pasien') is-invalid @enderror" placeholder="Masukkan nama pasien">
                                            @error('nama_pasien')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="jenis_kelamin">Jenis Kelamin</label>
                                            <select wire:model.lazy='jenis_kelamin' class="form-control @error('jenis_kelamin') is-invalid @enderror">
                                                <option selected>Pilih</option>
                                                <option value="L">Laki-laki</option>
                                                <option value="P">Perempuan</option>
                                            </select>
                                            @error('jenis_kelamin')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                     

                                        <div class="form-group">
                                            <label for="no_kk">Nomor Kartu Keluarga</label>
                                            <input type="number" wire:model.lazy='no_kk' class="form-control @error('no_kk') is-invalid @enderror" placeholder="Masukkan no kk pasien">
                                            @error('no_kk')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="no_ktp">Nomor KTP</label>
                                            <input type="number" wire:model.lazy='no_ktp' class="form-control @error('no_ktp') is-invalid @enderror" placeholder="Masukkan no ktp pasien">
                                            @error('no_ktp')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="no_bpjs">Nomor BPJS</label>
                                            <input type="text" wire:model.lazy='no_bpjs' class="form-control @error('no_bpjs') is-invalid @enderror" placeholder="Masukkan no bpjs pasien">
                                            @error('no_bpjs')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    
                                       @if (!$openForm)
                                            <button type="button" class="btn btn-primary" wire:loading.remove wire:click='openLoadForm'>Load More</button>
                                            <button wire:loading wire:target='openLoadForm' type="button" disabled class="btn btn-primary">
                                                <span class="spinner-border" role="status"
                                                aria-hidden="true"></span>
                                            </button>
                        
                                       @endif

                                        @if ($openForm)
                                            <div class="form-group">
                                                <label for="jaminan">Jaminan</label>
                                                <select wire:model.lazy='jaminan' class="form-control @error('jaminan') is-invalid @enderror">
                                                    <option selected>Pilih</option>
                                                    @foreach ($data_jaminan as $item)
                                                        <option value="{{ $item->id }}">{{ $item->nama_jaminan }}</option>
                                                    @endforeach
                                                </select>
                                                @error('jaminan')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="no_jaminan">Nomor Jaminan</label>
                                                <input type="text" wire:model.lazy='no_jaminan' class="form-control @error('no_jaminan') is-invalid @enderror" placeholder="Masukkan no jaminan pasien">
                                                @error('no_jaminan')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="tempat_lahir">Tempat Lahir</label>
                                                <input type="text" wire:model.lazy='tempat_lahir' class="form-control @error('tempat_lahir') is-invalid @enderror" placeholder="Masukkan tempat lahir pasien">
                                                @error('tempat_lahir')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="tanggal_lahir">Tanggal Lahir</label>
                                                <input type="date" wire:model.lazy='tanggal_lahir' class="form-control @error('tanggal_lahir') is-invalid @enderror">
                                                @error('tanggal_lahir')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="alamat">Alamat</label>
                                                <textarea rows="4" wire:model.lazy='alamat' class="form-control @error('alamat') is-invalid @enderror" placeholder="Masukkan alamat pasien"></textarea>
                                                @error('alamat')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="wilayah">Wilayah</label>
                                                <select wire:model.lazy='wilayah' class="form-control @error('wilayah') is-invalid @enderror">
                                                    <option selected>Pilih</option>
                                                    <option value="Dalam Wilayah">Dalam Wilayah</option>
                                                    <option value="Luar Wilayah">Luar Wilayah</option>
                                                </select>
                                                @error('wilayah')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            

                                    
                                            

                                            @if ($pasienId)
                                                <button class="btn btn-primary">Update</button>
                                            @else
                                                <button class="btn btn-primary">Submit</button>
                                        @endif
                                        @endif
                                        

                                    </form>
                                </div>

                            @else

                                <div class="card-header">
                                    <div class="d-flex justify-content-between">
                                        <h4>Data Pasien</h4>
                                        <div>
                                            <button wire:click='openFormCreatePasien' class="btn btn-sm btn-primary">Tambah Data</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">

                                    <div>
                                        <input type="text" wire:model='search' placeholder="Search by kode, nama">
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
                                                    <th>No Rekamedis</th>
                                                    <th>Nama Pasien</th>
                                                    <th>Usia</th>
                                                    <th>No KK</th>
                                                    <th>No KTP Pasien</th>
                                                    <th>No BPJS</th>
                                                    @if ($details)
                                                        <th>Jaminan</th>
                                                        <th>No Jaminan</th>
                                                        <th>Jenis Kelamin</th>
                                                        <th>TTL</th>
                                                        <th>Alamat</th>
                                                        <th>Wilayah</th>
                                                    @endif
                                                    <th>Actions</th>
                                                </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($pasiens as $key => $item)
                                                <tr>
                                                    <td>{{ $pasiens->firstItem() + $key }}</td>
                                                    <td>{{ $item->kode_paramedis }}</td>
                                                    <td>{{ $item->nama_pasien }}</td>
                                                    <td>{{ $item->usia }}</td>
                                                    <td>{{ $item->no_kk }}</td>
                                                    <td>{{ $item->no_ktp }}</td>
                                                    <td>{{ $item->no_bpjs }}</td>
                                                    @if ($details)
                                                        <td>{{ $item->jaminan->nama_jaminan }}</td>
                                                        <td>{{ $item->no_jaminan }}</td>
                                                        <td>{{ $item->jenis_kelamin }}</td>
                                                        <td>
                                                            {{ ucwords(strtolower($item->tempat_lahir)) }},
                                                            {{ Carbon\carbon::parse($item->tanggal_lahir)->format('d M Y') }} 
                                                        
                                                        </td>
                                                        <td>{{ $item->alamat }}</td>
                                                        <td>{{ $item->wilayah }}</td>
                                                    @endif
                                                    <td class="d-flex">
                                                        <button wire:click="openFormUpdatePasien({{ $item->id }})" class="btn btn-primary btn-sm">
                                                            <i class="bi bi-pencil-square"></i>
                                                        </button>
                                                        <button wire:click.prevent='deletePasien({{ $item->id }})' style="margin-left: 5px" class="btn btn-danger btn-sm">
                                                            <i class="bi bi-trash-fill"></i>
                                                        </button>
                                                    </td>
                                                </tr>

                                                @empty

                                                <td colspan="14" class="text-center">Data not found</td>
                                            @endforelse
                                        </tbody>
                                        </table>
                                    </div>

                                    <div>
                                        {{ $pasiens->links() }}
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