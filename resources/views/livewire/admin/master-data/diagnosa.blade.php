<div>

    @section('title', 'Master Data - Diagnosa')

    <div id="app">
        @include('livewire.admin.components.sidebar')
        <div id="main" class='layout-navbar'>
            @include('livewire.admin.components.header')
            <div id="main-content">

                <div class="page-heading">
                    <div class="page-title">
                        <div class="row">
                            <div class="order-last col-12 col-md-6 order-md-1">
                                <h3>Master Data - Diagnosa</h3>
                                <p class="text-subtitle text-muted">Hi, this is page for manajement data Diagnosa</p>
                            </div>
                            <div class="order-first col-12 col-md-6 order-md-2">
                                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{ route('dash.home') }}">Dashboard</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Master Data
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">Diagnosa
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
                                        <h4>Create Diagnosa</h4>
                                        <div>
                                            <button wire:click='closeFormCreateDiagnosa' class="btn btn-sm btn-primary">X</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <form
                                        @if ($diagnosaId)
                                            wire:submit.prevent='updateDiagnosa({{ $diagnosaId }})'
                                        @else
                                            wire:submit.prevent='saveDiagnosa'
                                        @endif
                                    >
                                        <div class="form-group">
                                            <label for="kode">Kode ICD</label>
                                            <input type="text" wire:model.lazy='kode' class="form-control @error('kode') is-invalid @enderror" placeholder="Masukkan kode diagnosa">
                                            @error('kode')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="nama_penyakit">Nama Penyakit</label>
                                            <input type="text" wire:model.lazy='nama_penyakit' class="form-control @error('nama_penyakit') is-invalid @enderror" placeholder="Masukkan nama penyakit">
                                            @error('nama_penyakit')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>




                                        @if ($diagnosaId)
                                            <button class="btn btn-primary">Update</button>
                                        @else
                                            <button class="btn btn-primary">Submit</button>
                                        @endif

                                    </form>
                                </div>

                            @elseif($openFormUpload)
                                <div class="card-header">
                                    <div class="d-flex justify-content-between">
                                        <h4>Upload Diagnosa</h4>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="file_excel">File</label>
                                        <input type="file" class="form-control @error('file_excel') is-invalid @enderror"
                                        wire:model='file_excel'>
                                        @error('file_excel')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <button wire:click='uploadExcel' wire:loading.remove class="btn btn-primary">Submit</button>
                                        <button wire:loading wire:target='uploadExcel' type="button" disabled class="btn btn-primary">
                                            <span class="spinner-border" role="status"
                                            aria-hidden="true"></span>
                                        </button> <span wire:loading wire:target='uploadExcel'>Deleting old file and uploading new file ...</span>
                                    </div>
                                </div>
                            @else

                                <div class="card-header">
                                    <div class="d-flex justify-content-between">
                                        <h4>Data Diagnosa</h4>
                                        <div>
                                            <button wire:click='openFormUploadExcel' class="btn btn-success btn-sm">
                                                <i class="bi bi-file-excel-fill"></i> <span>Import</span>
                                            </button>
                                            <button wire:click='openFormCreateDiagnosa' class="btn btn-sm btn-primary">Tambah Data</button>
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
                                                    <th>Kode ICD</th>
                                                    <th>Nama Penyakit</th>
                                                    <th>Actions</th>
                                                </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($diagnosas as $key => $item)
                                                <tr>
                                                    <td>{{ $diagnosas->firstItem() + $key }}</td>
                                                    <td>{{ $item->code }}</td>
                                                    <td>{{ $item->nama_penyakit }}</td>

                                                    <td class="d-flex">
                                                        <button wire:click="openFormUpdateDiagnosa({{ $item->id }})" class="btn btn-primary btn-sm">
                                                            <i class="bi bi-pencil-square"></i>
                                                        </button>
                                                        <button wire:click.prevent='deleteDiagnosa({{ $item->id }})' style="margin-left: 5px" class="btn btn-danger btn-sm">
                                                            <i class="bi bi-trash-fill"></i>
                                                        </button>
                                                    </td>
                                                </tr>

                                                @empty

                                                <td colspan="9" class="text-center">Data not found</td>
                                            @endforelse
                                        </tbody>
                                        </table>
                                    </div>

                                    <div>
                                        {{ $diagnosas->links() }}
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
