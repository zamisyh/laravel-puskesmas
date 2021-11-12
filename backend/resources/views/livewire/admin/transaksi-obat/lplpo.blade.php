<div>

    @section('title', 'Laporan Pemakaian Dan Lembar Permintaan Obat')

    <div id="app">
        @include('livewire.admin.components.sidebar')
        <div id="main" class='layout-navbar'>
            @include('livewire.admin.components.header')
            <div id="main-content">

                <div class="page-heading">
                    <div class="page-title">
                        <div class="row">
                            <div class="col-12 col-md-6 order-md-1 order-last">
                                <h3>Laporan Pemakaian Dan Lembar Permintaan Obat</h3>
                                <p class="text-subtitle text-muted">Hi, this is page for lplpo</p>
                            </div>
                            <div class="col-12 col-md-6 order-md-2 order-first">
                                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{ route('dash.home') }}">Dashboard</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Home
                                        </li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <section class="section">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h4 class="card-title">Data Obat</h4>
                                <div>
                                    <button class="btn btn-success btn-sm" wire:click='exportLplpo'>Export</button>
                                </div>
                            </div>
                            <div class="card-body">
                                @if ($openFormUpdate)
                                    <div class="form-group">
                                        <label for="nama_obat">Nama Obat</label>
                                        <input type="text" class="form-control" wire:model.lazy='nama_obat'" readonly>
                                    </div>

                                    <div class="form-group">
                                        @if (!$openDetailObat)
                                            <a href="#open" wire:click='openDetail'>Lihat detail obat</a>

                                        @else
                                            <a href="#close" wire:click='closeDetail'>Tutup detail obat</a>
                                        @endif
                                    </div>

                                   @if ($openDetailObat)
                                        <div class="form-group">
                                            <label for="kode_obat">Kode Obat</label>
                                            <input type="text" class="form-control" wire:model.lazy='kode_obat' readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="satuan">Satuan</label>
                                            <input type="text" class="form-control" wire:model.lazy='satuan' readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="dosis">Dosis</label>
                                            <input type="text" class="form-control" wire:model.lazy='dosis' readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="jenis_obat">Jenis Obat</label>
                                            <input type="text" class="form-control" wire:model.lazy='jenis_obat' readonly>
                                        </div>
                                   @endif

                                    <div class="form-group">
                                        <label for="stock_awal">Stok Awal</label>
                                        <input type="text" class="form-control" wire:model.lazy='stock_awal' readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="penerimaan">Penerimaan Obat</label>
                                        <input type="text" class="form-control" wire:model.lazy='penerimaan' readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="persediaan">Persediaan Obat</label>
                                        <input type="text" class="form-control" wire:model.lazy='persediaan' readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="pemakaian">Pemakaian Obat</label>
                                        <input type="text" class="form-control" wire:model.lazy='pemakaian' readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="rusak">Obat Rusak</label>
                                        <input type="number" class="form-control" wire:model.lazy='rusak' placeholder="Masukkan jumlah obat rusak">
                                    </div>
                                    <div class="form-group">
                                        <label for="recal">Recall Obat</label>
                                        <input type="number" class="form-control" wire:model.lazy='recal' placeholder="Masukkan recal obat">
                                    </div>
                                    <div class="form-group">
                                        <label for="stok_akhir">Stock Akhir</label>
                                        <input type="text" class="form-control" wire:model.lazy='stok_akhir' readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="rko">Kebutuhan Perbulan (RKO)</label>
                                        <input type="number" class="form-control" wire:model.lazy='rko' placeholder="Masukkan jumlah rko">
                                    </div>

                                    <div class="form-group">
                                        <label for="permintaan">Permintaan</label>
                                        <input type="number" class="form-control" wire:model.lazy='permintaan' placeholder="Masukkan jumlah permintaan">
                                    </div>
                                    

                                    <div class="form-group">
                                        <label for="pemberian">Pemberian</label>
                                        <input type="number" class="form-control" wire:model.lazy='pemberian' placeholder="Masukkan jumlah pemberian">
                                    </div>

                                    <div class="form-group">
                                        <label for="ket">Keterangan</label>
                                        <textarea rows="4" class="form-control" wire:model.lazy='ket' placeholder="Masukkan keterangan"></textarea>
                                    </div>



                                    <div class="form-group">
                                        <button wire:click='save' class="btn btn-primary">Save</button>
                                    </div>
                                @else
                                    
                                    <div class="mt-3 mb-3">
                                        <input type="text" placeholder="Search obat" wire:model='search'>
                                        <select wire:model='rows'>
                                            <option value="5" selected>5</option>
                                            <option value="10">10</option>
                                            <option value="15">15</option>
                                            <option value="20">20</option>
                                        </select>
                                    </div>
                                    
                                    <table class="table table-bordered table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Obat</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($obats as $key => $item)
                                                <tr>
                                                    <td>{{ $obats->firstItem() + $key }}</td>
                                                    <td>{{ $item->nama_obat }}</td>
                                                    <td>
                                                        <button wire:click='updateForm({{$item->id}})' class="btn btn-primary btn-sm">
                                                            <i class="bi bi-pencil-square"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @empty
                                                
                                            @endforelse
                                        </tbody>
                                    </table>

                                    <div class="mb-3">
                                        {{ $obats->links() }}
                                    </div>
                                @endif
                            </div>
                           
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
