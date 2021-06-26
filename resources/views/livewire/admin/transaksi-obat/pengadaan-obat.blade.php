<div>

    @section('title', 'Transaksi - Pengadaan Obat')

    <div id="app">
        @include('livewire.admin.components.sidebar')
        <div id="main" class='layout-navbar'>
            @include('livewire.admin.components.header')
            <div id="main-content">

                <div class="page-heading">
                    <div class="page-title">
                        <div class="row">
                            <div class="col-12 col-md-6 order-md-1 order-last">
                                <h3>Transaksi - Pengadaan Obat</h3>
                                <p class="text-subtitle text-muted">Hi, this is page for manajement data Pengadaan Obat</p>
                            </div>
                            <div class="col-12 col-md-6 order-md-2 order-first">
                                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{ route('dash.home') }}">Dashboard</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Transaksi
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">Pengadaan Obat
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
                                        <h4>Create Pengadaan Obat</h4>
                                        <div>
                                            <button wire:click='closeFormCreatePengadaanObat' class="btn btn-sm btn-primary">X</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <form
                                        @if ($pengadaanObatId)
                                            wire:submit.prevent='updatePengadaanObat({{ $pengadaanObatId }})'
                                        @else
                                            wire:submit.prevent='savePengadaanObat'
                                        @endif
                                    >
                                        
                                        <div class="form-group">
                                            <label for="no_batch">No Batch</label>
                                            <input type="text" wire:model.lazy='no_batch' class="form-control @error('no_batch') is-invalid @enderror"
                                            placeholder="Masukkan no batch">
                                            @error('no_batch')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="supplier">Nama Supplier</label>
                                            <select wire:model.lazy='supplier' class="form-control @error('supplier') is-invalid @enderror" id="supplier">
                                                <option selected>Pilih</option>
                                                 @foreach ($data_supplier as $item)
                                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                                 @endforeach
                                            </select>
                                            @error('supplier')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="obat">Nama Obat</label>
                                            <select wire:model.lazy='obat' class="form-control @error('obat') is-invalid @enderror" id="obat">
                                                <option selected>Pilih</option>
                                                 @foreach ($data_obat as $item)
                                                    <option value="{{ $item->id }}">{{ $item->nama_obat }}</option>
                                                 @endforeach
                                            </select>
                                            @error('obat')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                       <div class="form-group">
                                            @if (!$showObat)
                                                <a href="#!" wire:click='openDetailObat'>Lihat detail obat</a>
                                            @else
                                                <a href="#!" wire:click='closeDetailObat'>Tutup detail obat</a>
                                            @endif
                                       </div>

                                        @if ($showObat)
                                            <div class="form-group">
                                                <label for="kode_obat">Kode Obat</label>
                                                <input type="text" readonly wire:model.lazy='kode_obat' class="form-control @error('kode_obat') is-invalid @enderror">
                                                @error('kode_obat')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="jenis_obat">Jenis Obat</label>
                                                <input type="text" readonly wire:model.lazy='jenis_obat' class="form-control @error('jenis_obat') is-invalid @enderror">
                                                @error('jenis_obat')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="satuan">Satuan</label>
                                                <input type="text" readonly wire:model.lazy='satuan' class="form-control @error('satuan') is-invalid @enderror" placeholder="">
                                                @error('satuan')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        @endif
                                        

                                        <div class="form-group">
                                            <label for="harga_beli">Harga Beli</label>
                                            <input type="number" wire:model.lazy='harga_beli' class="form-control @error('harga_beli') is-invalid @enderror" placeholder="Masukkan Harga beli">
                                            @error('harga_beli')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="jumlah">Jumlah</label>
                                            <input type="number" wire:model.lazy='jumlah' class="form-control @error('jumlah') is-invalid @enderror" placeholder="Masukkan Harga beli">
                                            @error('jumlah')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="total">Total</label>
                                            <input type="text" readonly wire:model.lazy='total' class="form-control @error('total') is-invalid @enderror" placeholder="Klik untuk melihat total">
                                            @error('total')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="keterangan">Keterangan</label>
                                            <textarea rows="4" wire:model.lazy='keterangan' class="form-control @error('keterangan') is-invalid @enderror" placeholder="Masukkan keterangan"></textarea>
                                            @error('keterangan')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        
                                        @if ($pengadaanObatId)
                                            <button class="btn btn-primary">Update</button>
                                        @else
                                            <button class="btn btn-primary">Submit</button>
                                        @endif

                                    </form>
                                </div>

                            @else

                                <div class="card-header">
                                    <div class="d-flex justify-content-between">
                                        <h4>Data Pengadaan Obat</h4>
                                        <div>
                                            <button wire:click='openFormCreatePengadaanObat' class="btn btn-sm btn-primary">Tambah Data</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">

                                    <div>
                                        <input type="text" wire:model='search' placeholder="Search by no, supplier, nama obat">
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
                                                    <th>No Batch</th>
                                                    <th>Supplier</th>
                                                    <th>Nama Obat</th>
                                                    <th>Jenis Obat</th>
                                                    @if ($details)
                                                        <th>Harga Beli</th>
                                                        <th>Jumlah</th>
                                                        <th>Satuan</th>
                                                        <th>Total</th>
                                                    @endif
                                                    <th>Actions</th>
                                                </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($pengadaan_obat as $key => $item)
                                                <tr>
                                                    <td>{{ $pengadaan_obat->firstItem() + $key }}</td>
                                                    <td>{{ $item->no_trans }}</td>
                                                    <td>{{ $item->supplier->nama }}</td>
                                                    <td>{{ $item->obat->nama_obat }}</td>
                                                    <td>{{ $item->obat->jenis_obat }}</td>
                                                    @if ($details)
                                                        <td>{{ $item->harga_beli }}</td>
                                                        <td>{{ $item->jumlah }}</td>
                                                        <td>{{ $item->obat->satuan }}</td>
                                                        <td>Rp. {{ $item->total }}</td>
                                                    @endif
                                                    <td class="d-flex">
                                                        <button wire:click="openFormUpdatePengadaanObat({{ $item->id }})" class="btn btn-primary btn-sm">
                                                            <i class="bi bi-pencil-square"></i>
                                                        </button>
                                                        <button wire:click.prevent='deletePengadaanObat({{ $item->id }})' style="margin-left: 5px" class="btn btn-danger btn-sm">
                                                            <i class="bi bi-trash-fill"></i>
                                                        </button>
                                                    </td>
                                                </tr>

                                                @empty

                                                <td colspan="10" class="text-center">Data not found</td>
                                            @endforelse
                                        </tbody>
                                        </table>
                                    </div>

                                    <div>
                                        {{ $pengadaan_obat->links() }}
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
