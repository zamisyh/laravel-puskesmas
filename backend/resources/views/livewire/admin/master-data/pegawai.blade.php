<div>

    @section('title', 'Master Data - Pegawai')

    <div id="app">
        @include('livewire.admin.components.sidebar')
        <div id="main" class='layout-navbar'>
            @include('livewire.admin.components.header')
            <div id="main-content">

                <div class="page-heading">
                    <div class="page-title">
                        <div class="row">
                            <div class="col-12 col-md-6 order-md-1 order-last">
                                <h3>Master Data - Pegawai</h3>
                                <p class="text-subtitle text-muted">Hi, this is page for manajement data Pegawai</p>
                            </div>
                            <div class="col-12 col-md-6 order-md-2 order-first">
                                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{ route('dash.home') }}">Dashboard</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Master Data
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">Pegawai
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
                                        <h4>Create Pegawai</h4>
                                        <div>
                                            <button wire:click='closeFormCreatePegawai' class="btn btn-sm btn-primary">X</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <form
                                        @if ($pegawaiId)
                                            wire:submit.prevent='updatePegawai({{ $pegawaiId }})'
                                        @else
                                            wire:submit.prevent='savePegawai'
                                        @endif
                                    >
                                        <div class="form-group">
                                            <label for="nama_pegawai">Nama Pegawai</label>
                                            <input type="text" wire:model.lazy='nama_pegawai' class="form-control @error('nama_pegawai') is-invalid @enderror" placeholder="Masukkan nama pegawai">
                                            @error('nama_pegawai')
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
                                            <label for="npwp">NPWP</label>
                                            <input type="text" wire:model.lazy='npwp' class="form-control @error('npwp') is-invalid @enderror" placeholder="Masukkan NPWP">
                                            @error('npwp')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="bidang">Bidang</label>
                                            <select wire:model.lazy='bidang' class="form-control @error('bidang') is-invalid @enderror" id="bidang">
                                                <option selected>Pilih</option>
                                                 @foreach ($data_bidang as $item)
                                                    <option value="{{ $item->id }}">{{ $item->nama_bidang }}</option>
                                                 @endforeach
                                            </select>
                                            @error('bidang')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="jabatan">Jabatan</label>
                                            <select wire:model.lazy='jabatan' class="form-control @error('jabatan') is-invalid @enderror" id="jabatan">
                                                <option selected>Pilih</option>
                                                 @foreach ($data_jabatan as $item)
                                                    <option value="{{ $item->id }}">{{ $item->nama_jabatan }}</option>
                                                 @endforeach
                                            </select>
                                            @error('jabatan')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                      

                                        

                                        @if ($pegawaiId)
                                            <button class="btn btn-primary">Update</button>
                                        @else
                                            <button class="btn btn-primary">Submit</button>
                                        @endif

                                    </form>
                                </div>

                            @else

                                <div class="card-header">
                                    <div class="d-flex justify-content-between">
                                        <h4>Data Pegawai</h4>
                                        <div>
                                            <button wire:click='openFormCreatePegawai' class="btn btn-sm btn-primary">Tambah Data</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">

                                    <div>
                                        <input type="text" wire:model='search' placeholder="Search Pegawai">
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
                                                <th>NPWP</th>
                                                @if ($details)
                                                    <th>TTL</th>
                                                    <th>Jabatan</th>
                                                    <th>Bidang</th>
                                                @endif
                                                <th>Actions</th>
                                            </tr>   
                                        </thead>
                                        <tbody>
                                            @forelse ($pegawais as $key => $item)
                                                <tr>
                                                    <td>{{ $pegawais->firstItem() + $key }}</td>
                                                    <td>{{ $item->nama_pegawai }}</td>
                                                    <td>
                                                        @if ($item->jenis_kelamin == 'L')
                                                            <span class="badge bg-primary">L</span>

                                                        @else
                                                            <span class="badge bg-success">P</span>
                                                        @endif    
                                                    </td>    
                                                    <td>{{ $item->npwp }}</td>
                                                    @if ($details)
                                                        <td>
                                                            {{ ucwords(strtolower($item->tempat_lahir)) }},
                                                            {{ Carbon\carbon::parse($item->tanggal_lahir)->format('d M Y') }}
                                                        </td>
                                                        <td>{{ $item->jabatan->nama_jabatan }}</td>
                                                        <td>{{ $item->bidang->nama_bidang }}</td>
                                                    @endif
                                                    <td class="d-flex">
                                                        <button wire:click="openFormUpdatePegawai({{ $item->id }})" class="btn btn-primary btn-sm">
                                                            <i class="bi bi-pencil-square"></i>
                                                        </button>
                                                        <button wire:click.prevent='deletePegawai({{ $item->id }})' style="margin-left: 5px" class="btn btn-danger btn-sm">
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
                                        {{ $pegawais->links() }}
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
