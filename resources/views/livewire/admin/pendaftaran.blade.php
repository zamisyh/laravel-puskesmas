<div>

    @section('css')
        <link rel="stylesheet" href="{{ asset('assets/vendors/select2/select2.min.css') }}">
    @endsection

    @section('title', 'Pendaftaran')

    <div id="app">
       @if ($printPendaftaran)
       <center>
        <div class="">
            <img src="{{ asset('logo.ico') }}" height="80" width="80" class="mt-10">
            <h5 class="p-1">UPTD Puskesmas Perumnas 2</h5>
            <span>JL Belut Raya, No. 1, Kayuringin, <br> Bekasi Bekasi, Jawa Barat <br>Indonesia 17144. Phone: (021) 88954619</span>
        </div>
        <table class="table mt-2 w-25 table-bordered" border="4">
            <tr>
                <td style="font-weight: 700">No. RM</td>
                <td>{{ $this->dataPrint->kode_paramedis }}</td>
            </tr>
            <tr>
                <td style="font-weight: 700">No. Antrian </td>
                <td>{{ $this->dataPrint->no_antrian }}</td>
            </tr>
            <tr>
                <td style="font-weight: 700">Nama Pasien</td>
                <td>{{ $this->dataPrint->nama_pasien }}</td>
            </tr>
            <tr>
                <td style="font-weight: 700">Nama KK</td>
                <td>{{ $this->dataPrint->nama_kk }}</td>
            </tr>
            <tr>
                <td style="font-weight: 700">NIK</td>
                <td>{{ $this->dataPrint->no_ktp }}</td>
            </tr>
            <tr>
                <td style="font-weight: 700">Nama Poli</td>
                <td>{{ $this->dataPrintPoli->poli->nama_poli }}</td>
            </tr>
            <tr>
                <td style="font-weight: 700">Hubungan</td>
                <td>{{ ucwords(strtolower($this->dataPrint->hubungan_dengan_penanggung_jawab)) }}</td>
            </tr>
            <tr>
                <td style="font-weight: 700">Jaminan</td>
                <td>{{ $this->dataPrint->jaminan->nama_jaminan }} / {{ $this->dataPrint->no_jaminan }}</td>
            </tr>
            <tr>
                <td style="font-weight: 700">Tanggal Lahir</td>
                <td>{{ Carbon\carbon::parse($this->dataPrint->tanggal_lahir_kk)->format('d-m-Y') }}</td>
            </tr>
            <tr>
                <td style="font-weight: 700">Usia</td>
                <td>{{ $this->dataPrint->usia }}</td>
            </tr>
            <tr>
                <td style="font-weight: 700">Jenis Kelamin</td>
                <td>{{ $this->dataPrint->jenis_kelamin }}</td>
            </tr>
            <tr>
                <td style="font-weight: 700">Alamat</td>
                <td>{{ $this->dataPrint->alamat }}</td>
            </tr>
        </table>
</center
       @else
        @include('livewire.admin.components.sidebar')
        <div id="main" class='layout-navbar'>
            @include('livewire.admin.components.header')
            <div id="main-content">

                <div class="page-heading">
                    <div class="page-title">
                        <div class="row">
                            <div class="order-last col-12 col-md-6 order-md-1">
                                <h3>Pendaftaran</h3>
                                <p class="text-subtitle text-muted">Hi, this is page for manajement data Pendaftaran</p>
                            </div>
                            <div class="order-first col-12 col-md-6 order-md-2">
                                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{ route('dash.home') }}">Dashboard</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Pendaftaran
                                        </li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <section class="section">
                        <div class="card">
                            @if ($openFormCreate)

                                @include('livewire.admin.components.pasien')

                            @else

                                <div class="card-header">
                                    <div class="d-flex justify-content-between">
                                        <h4>Data Pendaftaran</h4>
                                        <div>
                                            <button wire:click='openFormCreatePendaftaran' class="btn btn-sm btn-primary">Tambah Data</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">

                                   <div class="d-flex justify-content-between">
                                        <div>
                                            <input type="text" wire:model='search' placeholder="Search by no, rekamedis, nama">
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
                                        <div>
                                            <input type="date" wire:model='from'> sampai
                                            <input type="date" wire:model='to'>
                                        </div>
                                   </div>

                                    <p></p>

                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped table-hover">
                                        <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>No Antrian</th>
                                                    <th>No Rekamedis</th>
                                                    <th>Nama Pasien</th>
                                                    <th>Jaminan</th>
                                                    @if ($details)
                                                        <th>Nama Dokter</th>
                                                        <th>Jenis Poli</th>
                                                    @endif
                                                    <th>Actions</th>
                                                </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($pendaftarans as $key => $item)
                                                <tr>
                                                    <td>{{ $pendaftarans->firstItem() + $key }}</td>
                                                    <td>{{ $item->pasien->no_antrian }}</td>
                                                    <td>{{ $item->no_rekammedis }}</td>
                                                    <td>{{ $item->pasien->nama_pasien }}</td>
                                                    <td>{{ $item->status_pasien }}</td>
                                                    @if ($details)
                                                        <td>{{ $item->dokter->nama_dokter }}</td>
                                                        <td>{{ $item->poli->nama_poli }}</td>
                                                    @endif
                                                    <td class="d-flex">
                                                        <button wire:click="openFormUpdatePendaftaran({{ $item->id }})" class="btn btn-primary btn-sm">
                                                            <i class="bi bi-pencil-square"></i>
                                                        </button>
                                                        <button wire:click.prevent='deletePendaftaran({{ $item->id }})' style="margin-left: 5px" class="btn btn-danger btn-sm">
                                                            <i class="bi bi-trash-fill"></i>
                                                        </button>
                                                        <button wire:click.prevent='printStructPendaftaran({{ $item->id }})' style="margin-left: 5px" class="btn btn-info btn-sm">
                                                            <i class="bi bi-printer-fill"></i>
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
                                        {{ $pendaftarans->links() }}
                                    </div>
                                </div>

                            @endif
                        </div>
                    </section>
                </div>

                @include('livewire.admin.components.footer')

            </div>
        </div>
       @endif
    </div>

    @section('js')

        <script src="{{ asset('assets/vendors/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/vendors/select2/select2.min.js') }}"></script>

        <script src="{{  asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
        <script src="{{  asset('assets/js/bootstrap.bundle.min.js') }}"></script>

        <script src="{{  asset('assets/js/main.js') }}"></script>


    @endsection
</div>





