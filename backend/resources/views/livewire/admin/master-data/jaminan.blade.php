<div>

    @section('title', 'Master Data - Jaminan')

    <div id="app">
        @include('livewire.admin.components.sidebar')
        <div id="main" class='layout-navbar'>
            @include('livewire.admin.components.header')
            <div id="main-content">

                <div class="page-heading">
                    <div class="page-title">
                        <div class="row">
                            <div class="col-12 col-md-6 order-md-1 order-last">
                                <h3>Master Data - Jaminan</h3>
                                <p class="text-subtitle text-muted">Hi, this is page for manajement data Jaminan</p>
                            </div>
                            <div class="col-12 col-md-6 order-md-2 order-first">
                                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{ route('dash.home') }}">Dashboard</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Master Data
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">Jaminan
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
                                        <h4>Create Jaminan</h4>
                                        <div>
                                            <button wire:click='closeFormCreateJaminan' class="btn btn-sm btn-primary">X</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <form wire:submit.prevent='saveJaminan'>
                                        <div class="form-group">
                                            <label for="nama_jaminan">Nama Jaminan</label>
                                            <input type="text" wire:model.lazy='nama_jaminan' class="form-control @error('nama_jaminan') is-invalid @enderror" placeholder="Masukkan nama Jaminan">
                                            @error('nama_jaminan')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        
                                        <div class="form-group">
                                            <button class="btn btn-primary">Save Jaminan</button>
                                        </div>
                                    </form>
                                </div>

                            @else

                                <div class="card-header">
                                    <div class="d-flex justify-content-between">
                                        <h4>Data Jaminan</h4>
                                        <div>
                                            <button wire:click='openFormCreateJaminan' class="btn btn-sm btn-primary">Tambah Data</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">

                                    <div>
                                        <input type="text" wire:model='search' placeholder="Search Jaminan">
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
                                                    <th>Nama Jaminan</th>
                                                    <th>Actions</th>
                                                </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($data_jaminan as $key => $item)
                                                <tr>
                                                    <td>{{ $data_jaminan->firstItem() + $key }}</td>
                                                    <td>{{ $item->nama_jaminan }}</td>
                                                    <td>
                                                        <button wire:click='deleteJaminan({{ $item->id }})' class="btn btn-danger btn-sm">
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
                                            {{ $data_jaminan->links() }}
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
