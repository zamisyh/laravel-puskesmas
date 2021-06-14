<div>

    @section('title', 'Master Data - Bidang')

    <div id="app">
        @include('livewire.admin.components.sidebar')
        <div id="main" class='layout-navbar'>
            @include('livewire.admin.components.header')
            <div id="main-content">

                <div class="page-heading">
                    <div class="page-title">
                        <div class="row">
                            <div class="col-12 col-md-6 order-md-1 order-last">
                                <h3>Master Data - Bidang</h3>
                                <p class="text-subtitle text-muted">Hi, this is page for manajement data Bidang</p>
                            </div>
                            <div class="col-12 col-md-6 order-md-2 order-first">
                                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{ route('dash.home') }}">Dashboard</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Master Data
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">Bidang
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
                                        <h4>Create Bidang</h4>
                                        <div>
                                            <button wire:click='closeFormCreateBidang' class="btn btn-sm btn-primary">X</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <form wire:submit.prevent='saveBidang'>
                                        <div class="form-group">
                                            <label for="nama_bidang">Nama Bidang</label>
                                            <input type="text" wire:model.lazy='nama_bidang' class="form-control @error('nama_bidang') is-invalid @enderror" placeholder="Masukkan nama Bidang">
                                            @error('nama_bidang')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        
                                        <div class="form-group">
                                            <button class="btn btn-primary">Save Bidang</button>
                                        </div>
                                    </form>
                                </div>

                            @else

                                <div class="card-header">
                                    <div class="d-flex justify-content-between">
                                        <h4>Data Bidang</h4>
                                        <div>
                                            <button wire:click='openFormCreateBidang' class="btn btn-sm btn-primary">Tambah Data</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">

                                    <div>
                                        <input type="text" wire:model='search' placeholder="Search Bidang">
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
                                                    <th>Nama Bidang</th>
                                                    <th>Actions</th>
                                                </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($data_bidang as $key => $item)
                                                <tr>
                                                    <td>{{ $data_bidang->firstItem() + $key }}</td>
                                                    <td>{{ $item->nama_bidang }}</td>
                                                    <td>
                                                        <button wire:click='deleteBidang({{ $item->id }})' class="btn btn-danger btn-sm">
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
                                            {{ $data_bidang->links() }}
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
