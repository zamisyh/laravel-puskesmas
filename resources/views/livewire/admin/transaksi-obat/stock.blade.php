<div>

    @section('title', 'Transaksi - Stok Obat')

    <div id="app">
        @include('livewire.admin.components.sidebar')
        <div id="main" class='layout-navbar'>
            @include('livewire.admin.components.header')
            <div id="main-content">

                <div class="page-heading">
                    <div class="page-title">
                        <div class="row">
                            <div class="col-12 col-md-6 order-md-1 order-last">
                                <h3>Transaksi - Stok Obat</h3>
                                <p class="text-subtitle text-muted">Hi, this is page for manajement data Stok Obat</p>
                            </div>
                            <div class="col-12 col-md-6 order-md-2 order-first">
                                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{ route('dash.home') }}">Dashboard</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Transaksi
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">Stok Obat
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
                                        <h4>Create Stok Obat</h4>
                                        <div>
                                            <button wire:click='closeFormCreateStokObat' class="btn btn-sm btn-primary">X</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <form
                                        @if ($obatId)
                                            wire:submit.prevent='updateStokObat({{ $obatId }})'
                                        @else
                                            wire:submit.prevent='saveStokObat'
                                        @endif
                                    >


                                        <div class="form-group">
                                            <label for="nama">Nama Obat</label>
                                            <select wire:model.lazy='nama' class="form-control @error('nama') is-invalid @enderror">
                                                <option selected>Pilih</option>
                                                @foreach ($data_obat as $item)
                                                    <option value="{{ $item->id }}">{{ $item->nama_obat }}</option>
                                                @endforeach
                                            </select>
                                            @error('nama')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="jumlah">Jumlah</label>
                                            <input type="number" wire:model.lazy='jumlah' class="form-control @error('jumlah') is-invalid @enderror" placeholder="Masukkan jumlah obat">
                                            @error('jumlah')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        

                                                        
                                        @if ($obatId)
                                            <button class="btn btn-primary">Update</button>
                                        @else
                                            <button class="btn btn-primary">Submit</button>
                                        @endif

                                    </form>
                                </div>

                            @else

                                <div class="card-header">
                                    <div class="d-flex justify-content-between">
                                        <h4>Data Stok Obat</h4>
                                        <div>
                                            <button wire:click='openFormCreateStokObat' class="btn btn-sm btn-primary">Tambah Data</button>
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

                                    
                                    </div>

                                    <p></p>

                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Kode Obat</th>
                                                <th>Nama Obat</th>
                                                <th>Jumlah</th>    
                                                <th>Satuan</th>
                                                <td>Actions</td>
                                               
                                            </tr>   
                                        </thead>
                                        <tbody>
                                            @forelse ($stokobats as $key => $item)
                                                <tr>
                                                    <td>{{ $stokobats->firstItem() + $key }}</td>
                                                    <td>{{ $item->obat->kode_obat }}</td>
                                                    <td>{{ $item->obat->nama_obat }}</td>
                                                    <td>{{ number_format($item->jumlah) }}</td>
                                                    <td>{{ $item->obat->satuan }}</td>
                                                   
                                                    <td class="d-flex">
                                                        <button wire:click="openFormUpdateStokObat({{ $item->id }})" class="btn btn-primary btn-sm">
                                                            <i class="bi bi-pencil-square"></i>
                                                        </button>
                                                        <button wire:click.prevent='deleteStokObat({{ $item->id }})' style="margin-left: 5px" class="btn btn-danger btn-sm">
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
                                        {{ $stokobats->links() }}
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
