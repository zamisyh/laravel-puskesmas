<div>

    @section('title', 'Master Data - Tindakan')

    <div id="app">
        @include('livewire.admin.components.sidebar')
        <div id="main" class='layout-navbar'>
            @include('livewire.admin.components.header')
            <div id="main-content">

                <div class="page-heading">
                    <div class="page-title">
                        <div class="row">
                            <div class="col-12 col-md-6 order-md-1 order-last">
                                <h3>Master Data - Tindakan</h3>
                                <p class="text-subtitle text-muted">Hi, this is page for manajement data Tindakan</p>
                            </div>
                            <div class="col-12 col-md-6 order-md-2 order-first">
                                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{ route('dash.home') }}">Dashboard</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Master Data
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">Tindakan
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
                                        <h4>Create Tindakan</h4>
                                        <div>
                                            <button wire:click='closeFormCreateTindakan' class="btn btn-sm btn-primary">X</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <form
                                        @if ($tindakanId)
                                            wire:submit.prevent='updateTindakan({{ $tindakanId }})'
                                        @else
                                            wire:submit.prevent='saveTindakan'
                                        @endif
                                    >

                                        <div class="form-group">
                                            <label for="kode">Kode Tindakan</label>
                                            <input type="text" wire:model.lazy='kode' class="form-control @error('kode') is-invalid @enderror" placeholder="Masukkan kode Tindakan">
                                            @error('kode')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="nama">Nama Tindakan</label>
                                            <input type="text" wire:model.lazy='nama' class="form-control @error('nama') is-invalid @enderror" placeholder="Masukkan nama Tindakan">
                                            @error('nama')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="tindakan_oleh">Tindakan Oleh</label>
                                            <select wire:model.lazy='tindakan_oleh' class="form-control @error('tindakan_oleh') is-invalid @enderror">
                                                <option selected>Pilih</option>
                                                <option value="dokter">Dokter</option>
                                                <option value="petugas">Petugas</option>
                                                <option value="dokter dan petugas">Dokter Dan Petugas</option>
                                            </select>
                                            @error('tindakan_oleh')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="poli">Tindakan Oleh</label>
                                            <select wire:model.lazy='poli' class="form-control @error('poli') is-invalid @enderror">
                                                <option selected>Pilih</option>
                                                 @forelse ($data_poli as $item)
                                                     <option value="{{ $item->id }}">{{ $item->nama_poli }}</option>
                                                 @empty
                                                    <option>Poli Kosong</option>
                                                 @endforelse
                                            </select>
                                            @error('poli')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>




                                        
                                                        
                                        @if ($tindakanId)
                                            <button class="btn btn-primary">Update</button>
                                        @else
                                            <button class="btn btn-primary">Submit</button>
                                        @endif

                                    </form>
                                </div>

                            @else

                                <div class="card-header">
                                    <div class="d-flex justify-content-between">
                                        <h4>Data Tindakan</h4>
                                        <div>
                                            <button wire:click='openFormCreateTindakan' class="btn btn-sm btn-primary">Tambah Data</button>
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
                                                <th>Tindakan Oleh</th>
                                                <th>Poli</th>
                                                <th>Actions</th>
                                            </tr>   
                                        </thead>
                                        <tbody>
                                            @forelse ($tindakans as $key => $item)
                                                <tr>
                                                    <td>{{ $tindakans->firstItem() + $key }}</td>
                                                    <td>{{ $item->kode_tindakan }}</td>
                                                    <td>{{ ucwords(strtolower( $item->nama_tindakan)) }}</td>    
                                                    <td>{{ ucwords(strtolower($item->tindakan_oleh)) }}</td>
                                                    <td>{{ $item->poli->nama_poli }}</td>
                                                 
                                                   
                                                    <td class="d-flex">
                                                        <button wire:click="openFormUpdateTindakan({{ $item->id }})" class="btn btn-primary btn-sm">
                                                            <i class="bi bi-pencil-square"></i>
                                                        </button>
                                                        <button wire:click.prevent='deleteTindakan({{ $item->id }})' style="margin-left: 5px" class="btn btn-danger btn-sm">
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
                                        {{ $tindakans->links() }}
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
