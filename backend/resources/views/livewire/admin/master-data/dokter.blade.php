<div>

    @section('title', 'Master Data - Dokter')

    <div id="app">
        @include('livewire.admin.components.sidebar')
        <div id="main" class='layout-navbar'>
            @include('livewire.admin.components.header')
            <div id="main-content">

                <div class="page-heading">
                    <div class="page-title">
                        <div class="row">
                            <div class="col-12 col-md-6 order-md-1 order-last">
                                <h3>Master Data - Dokter</h3>
                                <p class="text-subtitle text-muted">Hi, this is page for manajement data Dokter</p>
                            </div>
                            <div class="col-12 col-md-6 order-md-2 order-first">
                                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{ route('dash.home') }}">Dashboard</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Master Data
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">Dokter
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
                                        <h4>Create Dokter</h4>
                                        <div>
                                            <button wire:click='closeFormCreateDokter' class="btn btn-sm btn-primary">X</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <form
                                        @if ($dokterId)
                                            wire:submit.prevent='updateDokter({{ $dokterId }})'
                                        @else
                                            wire:submit.prevent='saveDokter'
                                        @endif
                                    >
                                        <div class="form-group">
                                            <label for="nama_dokter">Nama Dokter</label>
                                            <input type="text" wire:model.lazy='nama_dokter' class="form-control @error('nama_dokter') is-invalid @enderror" placeholder="Masukkan nama Dokter">
                                            @error('nama_dokter')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        

                                        <div class="form-group">
                                            <label for="nid">Nomor Induk Dokter</label>
                                            <input type="text" wire:model.lazy='nid' class="form-control @error('nid') is-invalid @enderror" placeholder="Masukkan no induk dokter">
                                            @error('nid')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="kode_dokter">Kode Dokter</label>
                                            <input type="text" wire:model.lazy='kode_dokter' class="form-control @error('kode_dokter') is-invalid @enderror" placeholder="Masukkan kode dokter">
                                            @error('kode_dokter')
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
                                        
                                        
                                        <div class="form-group">
                                            <label for="jenis_kelamin">Jenis Kelamin</label>
                                            <select wire:model.lazy='jenis_kelamin' class="form-control @error('jenis_kelamin') is-invalid @enderror" id="jenis_kelamin">
                                                <option selected>Pilih</option>
                                                <option value="L">Laki-laki</option>
                                                <option value="P">Perempuan</option>
                                            </select>
                                            @error('jenis_kelamin')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="tempat_lahir">Tempat Lahir</label>
                                            <input type="text" wire:model.lazy='tempat_lahir' class="form-control @error('tempat_lahir') is-invalid @enderror" placeholder="Masukkan tempat lahir">
                                            @error('tempat_lahir')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="tanggal_lahir">Tanggal Lahir</label>
                                            <input type="date" wire:model.lazy='tanggal_lahir' class="form-control @error('tanggal_lahir') is-invalid @enderror" placeholder="Masukkan tanggal lahir">
                                            @error('tanggal_lahir')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="alamat">Alamat</label>
                                            <textarea rows="4" wire:model.lazy='alamat' class="form-control @error('alamat') is-invalid @enderror" placeholder="Masukkan alamat"></textarea>
                                            @error('alamat')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        

                                  

                                        @if ($dokterId)
                                            <button class="btn btn-primary">Update</button>
                                        @else
                                            <button class="btn btn-primary">Submit</button>
                                        @endif

                                    </form>
                                </div>

                            @else

                                <div class="card-header">
                                    <div class="d-flex justify-content-between">
                                        <h4>Data Dokter</h4>
                                        <div>
                                            <button wire:click='openFormCreateDokter' class="btn btn-sm btn-primary">Tambah Data</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">

                                    <div>
                                        <input type="text" wire:model='search' placeholder="Search Dokter">
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
                                                <th>Jenis Kelamin</th>    
                                                <th>Nomor Induk Dokter</th>
                                                <th>Poli</th>
                                                @if ($details)
                                                    <th>TTL</th>
                                                    <th>Alamat</th>
                                                @endif
                                                <th>Actions</th>
                                            </tr>   
                                        </thead>
                                        <tbody>
                                            @forelse ($dokters as $key => $item)
                                                <tr>
                                                    <td>{{ $dokters->firstItem() + $key }}</td>
                                                    <td>{{ $item->nama_dokter }}</td>
                                                    <td>
                                                        @if ($item->jenis_kelamin == 'L')
                                                            <span class="badge bg-primary">L</span>

                                                        @else
                                                            <span class="badge bg-success">P</span>
                                                        @endif    
                                                    </td>    
                                                    <td>{{ $item->nid }}</td>
                                                    <td>{{ $item->poli->nama_poli }}</td>
                                                    @if ($details)
                                                        <td>
                                                            {{ ucwords(strtolower($item->tempat_lahir)) }},
                                                            {{ Carbon\carbon::parse($item->tanggal_lahir)->format('d M Y') }}
                                                        </td>
                                                        <td>{{ $item->alamat }}</td>
                                                    @endif
                                                    <td class="d-flex">
                                                        <button wire:click="openFormUpdateDokter({{ $item->id }})" class="btn btn-primary btn-sm">
                                                            <i class="bi bi-pencil-square"></i>
                                                        </button>
                                                        <button wire:click.prevent='deleteDokter({{ $item->id }})' style="margin-left: 5px" class="btn btn-danger btn-sm">
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
                                        {{ $dokters->links() }}
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
