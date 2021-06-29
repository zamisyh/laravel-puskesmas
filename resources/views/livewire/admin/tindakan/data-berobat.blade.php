<div>

    @section('css')
        <link rel="stylesheet" href="{{ asset('assets/vendors/select2/select2.min.css') }}">
    @endsection

    @section('title', 'Tindakan - Data Berobat')
    

    <div id="app">
        @include('livewire.admin.components.sidebar')
        <div id="main" class='layout-navbar'>
            @include('livewire.admin.components.header')
            <div id="main-content">

                <div class="page-heading">
                    <div class="page-title">
                        <div class="row">
                            <div class="col-12 col-md-6 order-md-1 order-last">
                                <h3>Tindakan - Data Berobat</h3>
                                <p class="text-subtitle text-muted">Hi, this is page for manajement data Berobat</p>
                            </div>
                            <div class="col-12 col-md-6 order-md-2 order-first">
                                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{ route('dash.home') }}">Dashboard</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Tindakan
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">Data Berobat
                                        </li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <section class="section">
                        @if ($openDataDetails)
                            <div class="row">
                                <div class="col-lg-7">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>Biodata Pasien</h4>
                                        </div>
                                        <div class="card-body">
                                            <table class="table table-bordered">
                                                <tr>
                                                    <td>No Rawat</td>
                                                    <td>{{ $no_rawat }}</td>
                                                </tr>
                                                <tr>
                                                    <td>No Rekamedis</td>
                                                    <td>{{ $no_rekamedis }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Nama Pasien</td>
                                                    <td>{{ ucwords(strtolower($nama_pasien)) }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-5">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>Actions</h4>
                                        </div>
                                        <div class="card-body">
                                            <table class="table">
                                                <tr>
                                                    <td> <button wire:click='openFormInputRujukanLab' type="button" class="btn btn-primary btn-sm">Input Rujukan Lab</button></td>
                                                    <td> <button type="button" class="btn btn-primary btn-sm">Cetak Rujukan Lab</button></td>
                                                </tr>
                                                <tr>
                                                    <td> <button wire:click='openFormInputTindakan' type="button" class="btn btn-success btn-sm">Input Tindakan</button></td>
                                                    <td> <button type="button" class="btn btn-success btn-sm">Cetak Rekamedis</button></td>
                                                </tr>
                                                <tr>
                                                    <td> <button wire:click='openFormInputResepObat' type="button" class="btn btn-info btn-sm">Input Resep Obat</button></td>
                                                    <td> <button type="button" class="btn btn-info btn-sm">Cetak Resep Obat</button></td>
                                                </tr>
                                                <tr>
                                                    <td> <button wire:click='openFormInputRujujan' type="button" class="btn btn-warning btn-sm">Input Rujukan</button></td>
                                                    <td> <button type="button" class="btn btn-warning btn-sm">Cetak Rujukan</button></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-4 mb-4">
                                @if ($i_lab)
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>Input Rujukan Lab</h4>
                                        </div>
                                        <div class="card-body" style="max-height: 400px; overflow-y:auto; ">
                                            <form wire:submit.prevent='saveRujukanLab'>
                                                <table class="table table-bordered table-hover">
                                                    <tbody>
                                                        @foreach ($data_lab as $item)
                                                            <tr>                                                                
                                                                <td>
                                                                    @if ($item->keterangan == 'Hematologi' OR 
                                                                    $item->keterangan == 'Kimia Darah' OR 
                                                                    $item->keterangan == 'Urinalisa' OR 
                                                                    $item->keterangan == 'Imuno / Serologi')
                                                                        <h4>{{ $item->keterangan }}</h4>

                                                                    @else
                                                                        {{ $item->keterangan }}
                                                                    @endif
                                                                </td>
                                                                 @if ($item->keterangan != 'Hematologi' &&
                                                                    $item->keterangan != 'Kimia Darah' &&
                                                                    $item->keterangan != 'Urinalisa' && 
                                                                    $item->keterangan != 'Imuno / Serologi')
                                                                    <td>
                                                                        <input type="checkbox" wire:model='lab_keterangan' value="{{ $item->id }}">
                                                                    </td>
                                                                 @endif
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>

                                                <button class="btn btn-success">Submit</button>
                                            </form>
                                        </div> 
                                    </div>

                                @elseif ($i_tindakan)
                                    @include('livewire.admin.tindakan.components.i-tindakan')
                                @elseif ($i_resep_obat)
                                    @include('livewire.admin.tindakan.components.i-resep-obat')
                                @elseif ($i_rujukan)
                                    @include('livewire.admin.tindakan.components.i-rujukan');
                                @endif
                            </div>

                            <div class="card">
                                <div class="card-header bg-success">
                                    <h4 class="text-white">Riwayat Tindakan</h4>
                                </div>
                                <div class="card-body mt-4">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Penyakit</th>
                                                    <th>Tindakan</th>
                                                    <th>Keluhan</th>
                                                    <th>Cek Fisik</th>
                                                    <th>Temperatur</th>
                                                    <th>Tinggi Badan</th>
                                                    <th>Tekanan Darah</th>
                                                    <th>Tekanan Nadi</th>
                                                    <th>HR</th>
                                                    <th>RR</th>
                                                    <th>BB</th>
                                                    <th>LP</th>
                                                    <th>Pemeriksa Penunjang</th>
                                                    <th>Rencana Pengobatan</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($data_riwayat as $key => $item)
                                                    <tr>
                                                        <td>{{ $data_riwayat->firstItem() + $key }}</td>
                                                        <td>
                                                           @foreach ($item->diagnosaMany as $d)
                                                             [ {{ $d->code }} ] {{ $d->nama_penyakit }},
                                                           @endforeach
                                                        </td>
                                                        <td>{{ $item->nama_tindakan }}</td>
                                                        <td>{{ $item->keluhan }}</td>
                                                        <td>{{ $item->cek_fisil }}</td>
                                                        <td>{{ $item->temperatur }}</td>
                                                        <td>{{ $item->tinggi_badan }}</td>
                                                        <td>{{ $item->tekanan_darah }}</td>
                                                        <td>{{ $item->tekanan_nadi }}</td>
                                                        <td>{{ $item->hr }}</td>
                                                        <td>{{ $item->rr }}</td>
                                                        <td>{{ $item->bb }}</td>
                                                        <td>{{ $item->lp }}</td>
                                                        <td>{{ $item->penunjang }}</td>
                                                        <td>{{ $item->rencana_pengobatan }}</td>
                                                        <td>
                                                            <button wire:click.prevent='deleteDataRiwayatTindakan({{ $item->id }})' style="margin-left: 5px" class="btn btn-danger btn-sm">
                                                                <i class="bi bi-trash-fill"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>

                                        <div class="form-group">
                                            {{ $data_riwayat->links() }}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header bg-success">
                                    <h4 class="text-white">Resep Obat</h4>
                                </div>
                                <div class="card-body mt-4">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Obat</th>
                                                    <th>Jenis</th>
                                                    <th>Dosis</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                 
                                             @foreach ($data_resep_obat as $key => $item)
                                                 <tr>
                                                     <td>{{ $data_resep_obat->firstItem() + $key }}</td>
                                                     <td>{{ $item->obat->nama_obat }}</td>
                                                     <td>{{ $item->jenis_obat }}</td>
                                                     <td>{{ $item->dosis }}</td>
                                                     <td>
                                                         <button wire:click.prevent='deleteDataResepObat({{ $item->id }})' style="margin-left: 5px" class="btn btn-danger btn-sm">
                                                             <i class="bi bi-trash-fill"></i>
                                                         </button>
                                                     </td>
                                                 </tr>
                                             @endforeach

                                          </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="card">  
                                <div class="card-header">
                                    <h4>Data Berobat</h4>
                                </div>
                                <div class="card-body">

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

                                    <p></p>

                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped table-hover">
                                        <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>No Rawat</th>
                                                    <th>No Rekamedis</th>
                                                    <th>Nama Pasien</th>
                                                    <th>Status</th>
                                                    @if ($details)
                                                        <th>Nama Dokter</th>
                                                        <th>Jenis Poli</th>
                                                    @endif
                                                    <th>Actions</th>
                                                </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($data_berobat as $key => $item)
                                                <tr>
                                                    <td>{{ $data_berobat->firstItem() + $key }}</td>
                                                    <td>{{ $item->no_rawat }}</td>
                                                    <td>{{ $item->no_rekammedis }}</td>
                                                    <td>{{ $item->pasien->nama_pasien }}</td>
                                                    <td>{{ $item->status_pasien }}</td>
                                                    @if ($details)
                                                        <td>{{ $item->dokter->nama_dokter }}</td>
                                                        <td>{{ $item->poli->nama_poli }}</td>
                                                    @endif
                                                        <td class="d-flex">
                                                            <button wire:click="openFormDetails({{ $item->id }})" class="btn btn-primary btn-sm">
                                                                <i class="bi bi-eye"></i>
                                                            </button>
                                                            <button wire:click.prevent='deleteDataBerobat({{ $item->id }})' style="margin-left: 5px" class="btn btn-danger btn-sm">
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
                                        {{ $data_berobat->links() }}
                                    </div>
                                
                                </div>

                                
                            </div>
                        @endif
                    </section>
                </div>

                @include('livewire.admin.components.footer')

            </div>
        </div>
    </div>

    @section('js')

        <script src="{{ asset('assets/vendors/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/vendors/select2/select2.min.js') }}"></script>


        <script src="{{  asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
        <script src="{{  asset('assets/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{  asset('assets/js/main.js') }}"></script>
    @endsection
</div>
