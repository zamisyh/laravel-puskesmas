<div>

    @section('title', 'Master Data - Obat')

    <div id="app">
        @include('livewire.admin.components.sidebar')
        <div id="main" class='layout-navbar'>
            @include('livewire.admin.components.header')
            <div id="main-content">

                <div class="page-heading">
                    <div class="page-title">
                        <div class="row">
                            <div class="col-12 col-md-6 order-md-1 order-last">
                                <h3>Master Data - Obat</h3>
                                <p class="text-subtitle text-muted">Hi, this is page for manajement data Obat</p>
                            </div>
                            <div class="col-12 col-md-6 order-md-2 order-first">
                                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{ route('dash.home') }}">Dashboard</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Master Data
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">Obat
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
                                        <h4>Create Obat</h4>
                                        <div>
                                            <button wire:click='closeFormCreateObat' class="btn btn-sm btn-primary">X</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <form
                                        @if ($obatId)
                                            wire:submit.prevent='updateObat({{ $obatId }})'
                                        @else
                                            wire:submit.prevent='saveObat'
                                        @endif
                                    >

                                        <div class="form-group">
                                            <label for="kode">Kode Obat</label>
                                            <input type="text" wire:model.lazy='kode' class="form-control @error('kode') is-invalid @enderror" placeholder="Masukkan kode obat">
                                            @error('kode')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="nama">Nama Obat</label>
                                            <input type="text" wire:model.lazy='nama' class="form-control @error('nama') is-invalid @enderror" placeholder="Masukkan nama obat">
                                            @error('nama')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="jenis">Jenis Obat</label>
                                            <input type="text" wire:model.lazy='jenis' class="form-control @error('jenis') is-invalid @enderror" placeholder="Masukkan jenis obat">
                                            @error('jenis')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="dosis">Dosis Aturan Obat</label>
                                            <input type="text" wire:model.lazy='dosis' class="form-control @error('dosis') is-invalid @enderror" placeholder="Masukkan dosis obat">
                                            @error('dosis')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="satuan">Jenis Satuan Obat</label>
                                            <input type="text" wire:model.lazy='satuan' class="form-control @error('satuan') is-invalid @enderror" placeholder="Masukkan satuan obat">
                                            @error('satuan')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="sediaan">Sediaan Obat</label>
                                            <input type="text" wire:model.lazy='sediaan' class="form-control @error('sediaan') is-invalid @enderror" placeholder="Masukkan sediaan obat">
                                            @error('sediaan')
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
                                        <h4>Data Obat</h4>
                                        <div>
                                            <button wire:click='openFormCreateObat' class="btn btn-sm btn-primary">Tambah Data</button>
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
                                                <th>Kode</th>
                                                <th>Nama</th>    
                                                <th>Jenis</th>
                                                <th>Dosis</th>
                                                <th>Satuan</th>
                                                <th>Sediaan</th>
                                                <th>Actions</th>
                                            </tr>   
                                        </thead>
                                        <tbody>
                                            @forelse ($obats as $key => $item)
                                                <tr>
                                                    <td>{{ $obats->firstItem() + $key }}</td>
                                                    <td>{{ $item->kode_obat }}</td>
                                                    <td>{{ $item->nama_obat }}</td>    
                                                    <td>{{ $item->jenis_obat }}</td>
                                                    <td>{{ $item->dosis_aturan_obat }}</td>
                                                    <td>{{ $item->satuan }}</td>
                                                    <td>{{ $item->sediaan }}</td>
                                                   
                                                    <td class="d-flex">
                                                        <button wire:click="openFormUpdateObat({{ $item->id }})" class="btn btn-primary btn-sm">
                                                            <i class="bi bi-pencil-square"></i>
                                                        </button>
                                                        <button wire:click.prevent='deleteObat({{ $item->id }})' style="margin-left: 5px" class="btn btn-danger btn-sm">
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
                                        {{ $obats->links() }}
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
