<div>

    @section('title', 'Transaksi - Pengeluaran Obat')

    <div id="app">
        @include('livewire.admin.components.sidebar')
        <div id="main" class='layout-navbar'>
            @include('livewire.admin.components.header')
            <div id="main-content">

                <div class="page-heading">
                    <div class="page-title">
                        <div class="row">
                            <div class="order-last col-12 col-md-6 order-md-1">
                                <h3>Transaksi - Pengeluaran Obat</h3>
                                <p class="text-subtitle text-muted">Hi, this is page for manajement data Pengeluaran Obat</p>
                            </div>
                            <div class="order-first col-12 col-md-6 order-md-2">
                                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{ route('dash.home') }}">Dashboard</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Transaksi
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">Pengeluaran Obat
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
                                        <h4>Create Pengeluaran Obat</h4>
                                        <div>
                                            {{-- <button wire:click='closeFormCreatePengeluaranObat' class="btn btn-sm btn-primary">X</button> --}}
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <form
                                        @if ($pengeluaranObatId)
                                            wire:submit.prevent='updatePengeluaranObat({{ $pengeluaranObatId }})'
                                        @else
                                            wire:submit.prevent='savePengeluaranObat'
                                        @endif
                                    >

                                        <div class="form-group">
                                            <label for="nama_pasien">Nama Pasien</label>
                                            <select wire:model.lazy='nama_pasien' class="form-control @error('nama_pasien') is-invalid @enderror" id="nama_pasien">
                                                <option selected>Pilih</option>
                                                 @foreach ($data_pasien as $item)
                                                    <option value="{{ $item->id }}">{{ $item->nama_pasien }}</option>
                                                 @endforeach
                                            </select>
                                            @error('nama_pasien')
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
                                                <label for="dosis">Dosis Aturan Obat</label>
                                                <input type="text" readonly wire:model.lazy='dosis' class="form-control @error('dosis') is-invalid @enderror">
                                                @error('dosis')
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
                                            <label for="jumlah">Jumlah</label>
                                            <input type="number" wire:model.lazy='jumlah' class="form-control @error('jumlah') is-invalid @enderror" placeholder="Masukkan Harga beli">
                                            @error('jumlah')
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

                                        @if ($pengeluaranObatId)
                                            <button class="btn btn-primary">Update</button>
                                        @else
                                            <button class="btn btn-primary">Submit</button>
                                        @endif

                                    </form>
                                </div>

                            @else

                                <div class="card-header">
                                    <div class="d-flex justify-content-between">
                                        <h4>Data Pengeluaran Obat</h4>
                                        <div>
                                            {{-- <button wire:click='openFormCreatePengeluaranObat' class="btn btn-sm btn-primary">Tambah Data</button> --}}
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">

                                    <div>
                                        <input type="text" wire:model='search' placeholder="Search by kode, nama, obat">
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
                                                    <th>Kode Pengeluaran</th>
                                                    <th>Nama Pasien</th>
                                                    <th>Nama Obat</th>
                                                    <th>Jenis Obat</th>
                                                    @if ($details)
                                                        <th>Jumlah</th>
                                                        <th>Satuan</th>
                                                        <th>Sedian</th>
                                                    @endif
                                                    <th>Actions</th>
                                                </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($pengeluaran_obat as $key => $item)
                                                <tr>
                                                    <td>{{ $pengeluaran_obat->firstItem() + $key }}</td>
                                                    <td>{{ $item->no_terima_obat }}</td>
                                                    <td>{{ $item->pasien->nama_pasien }}</td>
                                                    <td>{{ $item->obat->nama_obat }}</td>
                                                    <td>{{ $item->obat->jenis_obat }}</td>
                                                    @if ($details)
                                                        <td>{{ $item->jumlah }}</td>
                                                        <td>{{ $item->obat->satuan }}</td>
                                                        <td>{{ $item->obat->sediaan }}</td>
                                                    @endif
                                                    <td class="d-flex">
                                                        <button wire:click="openFormUpdatePengeluaranObat({{ $item->id }})" class="btn btn-primary btn-sm">
                                                            <i class="bi bi-pencil-square"></i>
                                                        </button>
                                                        <button wire:click.prevent='deletePengeluaranObat({{ $item->id }})' style="margin-left: 5px" class="btn btn-danger btn-sm">
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
                                        {{ $pengeluaran_obat->links() }}
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
