<div>

    @section('title', 'Master Data - Jabatan')

    <div id="app">
        @include('livewire.admin.components.sidebar')
        <div id="main" class='layout-navbar'>
            @include('livewire.admin.components.header')
            <div id="main-content">

                <div class="page-heading">
                    <div class="page-title">
                        <div class="row">
                            <div class="col-12 col-md-6 order-md-1 order-last">
                                <h3>Master Data - Jabatan</h3>
                                <p class="text-subtitle text-muted">Hi, this is page for manajement data Jabatan</p>
                            </div>
                            <div class="col-12 col-md-6 order-md-2 order-first">
                                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{ route('dash.home') }}">Dashboard</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Master Data
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">Jabatan
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
                                        <h4>Create Jabatan</h4>
                                        <div>
                                            <button wire:click='closeFormCreateJabatan' class="btn btn-sm btn-primary">X</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <form wire:submit.prevent='saveJabatan'>
                                        <div class="form-group">
                                            <label for="nama_jabatan">Nama Jabatan</label>
                                            <input type="text" wire:model.lazy='nama_jabatan' class="form-control @error('nama_jabatan') is-invalid @enderror" placeholder="Masukkan nama Jabatan">
                                            @error('nama_jabatan')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        
                                        <div class="form-group">
                                            <button class="btn btn-primary">Save Jabatan</button>
                                        </div>
                                    </form>
                                </div>

                            @else

                                <div class="card-header">
                                    <div class="d-flex justify-content-between">
                                        <h4>Data Jabatan</h4>
                                        <div>
                                            <button wire:click='openFormCreateJabatan' class="btn btn-sm btn-primary">Tambah Data</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">

                                    <div>
                                        <input type="text" wire:model='search' placeholder="Search Jabatan">
                                        <select wire:model='rows'>
                                            <option value="5" selected>5</option>
                                            <option value="10">10</option>
                                            <option value="15">15</option>
                                            <option value="20">20</option>
                                        </select>
                                    </div>

                                    <p></p>

                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped table-hover">
                                        <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Jabatan</th>
                                                    <th>Actions</th>
                                                </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($data_jabatan as $key => $item)
                                                <tr>
                                                    <td>{{ $data_jabatan->firstItem() + $key }}</td>
                                                    <td>{{ $item->nama_jabatan }}</td>
                                                    <td>
                                                        <button wire:click='deleteJabatan({{ $item->id }})' class="btn btn-danger btn-sm">
                                                            <i class="bi bi-trash-fill"></i>
                                                        </button>
                                                    </td>
                                                </tr>

                                                @empty
                                                <td colspan="4" class="text-center">No Data Found</td>



                                            @endforelse
                                        </tbody>
                                        </table>

                                        <div>
                                            {{ $data_jabatan->links() }}
                                        </div>
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
