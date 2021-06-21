<div>

    @section('title', 'Tindakan - Perbaikan Gizi')

    <div id="app">
        @include('livewire.admin.components.sidebar')
        <div id="main" class='layout-navbar'>
            @include('livewire.admin.components.header')
            <div id="main-content">

                <div class="page-heading">
                    <div class="page-title">
                        <div class="row">
                            <div class="col-12 col-md-6 order-md-1 order-last">
                                <h3>Tindakan - Perbaikan Gizi</h3>
                                <p class="text-subtitle text-muted">Hi, this is page for manajement data Perbaikan Gizi</p>
                            </div>
                            <div class="col-12 col-md-6 order-md-2 order-first">
                                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{ route('dash.home') }}">Dashboard</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Tindakan
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">Perbaikan Gizi
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
                                        <h4>{{ $perbaikanGiziId ? 'Update' : 'Create' }} Perbaikan Gizi</h4>
                                        <div>
                                            <button wire:click='closeFormCreatePerbaikanGizi' class="btn btn-sm btn-primary">X</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <form
                                        @if ($perbaikanGiziId)
                                            wire:submit.prevent='updatePerbaikanGizi({{ $perbaikanGiziId }})'
                                        @else
                                            wire:submit.prevent='savePerbaikanGizi'
                                        @endif
                                    >

                                        <div class="form-group">
                                            <label for="nama_anak">Nama Anak</label>
                                            <input type="text" wire:model.lazy='nama_anak' class="form-control @error('nama_anak') is-invalid @enderror" placeholder="Masukkan nama anak">
                                            @error('nama_anak')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="nama_tindakan">Nama Tindakan</label>
                                            <input type="text" wire:model.lazy='nama_tindakan' class="form-control @error('nama_tindakan') is-invalid @enderror" placeholder="Masukkan nama timdakan">
                                            @error('nama_tindakan')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="tanggal">Nama Obat</label>
                                            <input type="text" wire:model.lazy='nama_obat' class="form-control @error('nama_obat') is-invalid @enderror" placeholder="Masukkan nama obat">
                                            @error('nama_obat')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="jumlah">Jumlah</label>
                                            <input type="number" wire:model.lazy='jumlah' class="form-control @error('jumlah') is-invalid @enderror" placeholder="Masukkan jumlah">
                                            @error('jumlah')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="satuan">Satuan</label>
                                            <input type="text" wire:model.lazy='satuan' class="form-control @error('satuan') is-invalid @enderror" placeholder="Masukkan satuan">
                                            @error('satuan')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="tanggal">Tanggal</label>
                                            <input type="date" wire:model.lazy='tanggal' class="form-control @error('tanggal') is-invalid @enderror">
                                            @error('tanggal')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>



                                       
                                        

                                                        
                                        @if ($perbaikanGiziId)
                                            <button class="btn btn-primary">Update</button>
                                        @else
                                            <button class="btn btn-primary">Submit</button>
                                        @endif

                                    </form>
                                </div>

                            @else

                                <div class="card-header">
                                    <div class="d-flex justify-content-between">
                                        <h4>Data Perbaikan Gizi</h4>
                                        <div>
                                            <button wire:click='openFormCreatePerbaikanGizi' class="btn btn-sm btn-primary">Tambah Data</button>
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
                                                <th>Nama Anak</th>
                                                <th>Tidakan</th>    
                                                <th>Nama Obat</th>
                                                <th>Jumlah</th>
                                                <th>Satuan</th>
                                                <th>Tanggal</th>
                                                <th>Actions</th>
                                            </tr>   
                                        </thead>
                                        <tbody>
                                            @forelse ($perbaikan_gizis as $key => $item)
                                                <tr>
                                                    <td>{{ $perbaikan_gizis->firstItem() + $key }}</td>
                                                    <td>{{ $item->nama_anak }}</td>
                                                    <td>{{ $item->nama_tindakan }}</td>    
                                                    <td>{{ $item->nama_obat }}</td>
                                                    <td>{{ $item->jumlah }}</td>
                                                    <td>{{ $item->satuan }}</td>
                                                    <td>{{ Carbon\carbon::parse($item->tanggal)->format('d M Y') }}</td>
                                                   
                                                    <td class="d-flex">
                                                        <button wire:click="openFormUpdatePerbaikanGizi({{ $item->id }})" class="btn btn-primary btn-sm">
                                                            <i class="bi bi-pencil-square"></i>
                                                        </button>
                                                        <button wire:click.prevent='deletePerbaikanGizi({{ $item->id }})' style="margin-left: 5px" class="btn btn-danger btn-sm">
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
                                        {{ $perbaikan_gizis->links() }}
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
