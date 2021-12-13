<div>

    @section('title', 'Master Data - Paramedis')

    <div id="app">
        @include('livewire.admin.components.sidebar')
        <div id="main" class='layout-navbar'>
            @include('livewire.admin.components.header')
            <div id="main-content">

                <div class="page-heading">
                    <div class="page-title">
                        <div class="row">
                            <div class="col-12 col-md-6 order-md-1 order-last">
                                <h3>Master Data - Paramedis</h3>
                                <p class="text-subtitle text-muted">Hi, this is page for manajement data paramedis</p>
                            </div>
                            <div class="col-12 col-md-6 order-md-2 order-first">
                                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{ route('dash.home') }}">Dashboard</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Master Data
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">Paramedis
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
                                        <h4>Create Paramedis</h4>
                                        <div>
                                            <button wire:click='closeFormCreateParamedis' class="btn btn-sm btn-primary">X</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <form
                                        @if ($paramedisId)
                                            wire:submit.prevent='updateParamedis({{ $paramedisId }})'
                                        @else
                                            wire:submit.prevent='saveParamedis'
                                        @endif
                                    >
                                        <div class="form-group">
                                            <label for="name">Nama</label>
                                            <input type="text" wire:model.lazy='nama' class="form-control @error('nama') is-invalid @enderror" placeholder="Masukkan nama">
                                            @error('nama')
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
                                            <label for="alamat_tinggal">Alamat Lahir</label>
                                            <textarea rows="5" wire:model.lazy='alamat_tinggal' class="form-control @error('alamat_tinggal') is-invalid @enderror"></textarea>
                                            @error('alamat_tinggal')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="kode_paramedis">Kode Paramedis</label>
                                            <input type="text" wire:model.lazy='kode_paramedis' class="form-control @error('kode_paramedis') is-invalid @enderror" placeholder="Masukkan kode paramedis">
                                            @error('kode_paramedis')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="no_izin_paramedis">No Izin Paramedis</label>
                                            <input type="text" wire:model.lazy='no_izin_paramedis' class="form-control @error('no_izin_paramedis') is-invalid @enderror" placeholder="Masukkan nomor izin paramedis">
                                            @error('no_izin_paramedis')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="poli">Poli</label>
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

                                        @if ($paramedisId)
                                            <button class="btn btn-primary">Update</button>
                                        @else
                                            <button class="btn btn-primary">Submit</button>
                                        @endif

                                    </form>
                                </div>

                            @else

                                <div class="card-header">
                                    <div class="d-flex justify-content-between">
                                        <h4>Data Paramedis</h4>
                                        <div>
                                            <button wire:click='openFormCreateParamedis' class="btn btn-sm btn-primary">Tambah Data</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">

                                    <div>
                                        <input type="text" wire:model='search' placeholder="Search paramedis">
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
                                                    <th>Kode Paramedis</th>
                                                    <th>No Izin Paramedis</th>
                                                    <th>Nama</th>
                                                    <th>Poli</th>
                                                    @if ($details)
                                                        <th>Jenis Kelamin</th>
                                                        <th>TTL</th>
                                                        <th>Alamat</th>
                                                    @endif
                                                    <th>Actions</th>
                                                </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($paramedis as $key => $item)
                                                <tr>
                                                    <td>{{ $paramedis->firstItem() + $key }}</td>
                                                    <td>{{ $item->kode_paramedis }}</td>
                                                    <td>{{ $item->no_izin_paramedis }}</td>
                                                    <td>{{ $item->nama_paramedis }}</td>
                                                    <td>{{ $item->poli->nama_poli }}</td>
                                                    @if ($details)
                                                        <td>
                                                            @if ($item->jenis_kelamin == 'L')
                                                                <span class="badge bg-primary">L</span>

                                                            @else
                                                                <span class="badge bg-success">P</span>
                                                            @endif
                                                        </td>
                                                        <td>{{ ucwords(strtolower($item->tempat_lahir)) }},
                                                            {{ Carbon\carbon::parse($item->tanggal_lahir)->format('d M Y') }}</td>
                                                        <td>{{ $item->alamat }}</td>
                                                    @endif
                                                    <td class="d-flex">
                                                        <button wire:click="openFormUpdateParamedis({{ $item->id }})" class="btn btn-primary btn-sm">
                                                            <i class="bi bi-pencil-square"></i>
                                                        </button>
                                                        <button wire:click.prevent='deleteParamedis({{ $item->id }})' style="margin-left: 5px" class="btn btn-danger btn-sm">
                                                            <i class="bi bi-trash-fill"></i>
                                                        </button>
                                                    </td>
                                                </tr>

                                                @empty

                                                <td colspan="9" class="text-center">Data not found</td>
                                            @endforelse
                                        </tbody>
                                        </table>
                                    </div>

                                    <div>
                                        {{ $paramedis->links() }}
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
