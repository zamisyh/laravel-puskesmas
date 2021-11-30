<div>

    @section('css')
        <link rel="stylesheet" href="{{ asset('assets/vendors/simple-datatables/style.css') }}">

        <style>
            .closed:hover{
                cursor: pointer;
                opacity: 5.0;
            }
        </style>
    @endsection

    @section('title', 'Reports')

    <div id="app">
        @include('livewire.admin.components.sidebar')
        <div id="main" class='layout-navbar'>
            @include('livewire.admin.components.header')
            <div id="main-content">

                <div class="page-heading">
                    <div class="page-title">
                        <div class="row">
                            <div class="order-last col-12 col-md-6 order-md-1">
                                <h3>Reports</h3>
                                <p class="text-subtitle text-muted">Hi, this is the main report page</p>
                            </div>
                            <div class="order-first col-12 col-md-6 order-md-2">
                                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{ route('dash.home') }}">Dashboard</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Report
                                        </li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <section class="section">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h4 class="card-title">Data {{ $title }}</h4>
                                <div>
                                    <select wire:model='choice' class="form-select">
                                        <option value="dokter">Dokter</option>
                                        <option value="pasien">Pasien</option>
                                        <option value="pendaftaran">Pendaftaran</option>
                                        <option value="obat">Resep Obat</option>
                                        <option value="lab">Laboratorium</option>
                                    </select>
                                </div>
                            </div>
                            <div class="card-body">
                               @if ($choice == 'pasien')

                               <div class="d-flex justify-content-between">
                                    <div class="mt-3 mb-3">
                                        <input type="text" wire:model='search' placeholder="Search data {{ strtolower($title) }}">
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
                                    <div></div>
                               </div>

                               <div class="mt-1 mb-4 d-flex">
                                @if (!$filter)
                                     <div>
                                        <button wire:click='openFormFilter' class="btn btn-success btn-sm">
                                            <i class="bi bi-filter-right"></i>
                                        </button>
                                     </div>
                                @else

                                    <div class="d-flex">
                                         <span style="margin-right:6px;" class="text-danger closed" wire:click='closeFormFilter'>
                                             <i class="bi bi-x-square"></i>
                                         </span>
                                         <select wire:model='resFilter'>
                                             <option value="" selected>Pilih</option>
                                             <option value="byDate">By Date</option>
                                             <option value="byAll">By All</option>
                                         </select>
                                    </div>

                                @endif

                                <div style="margin-left:5px;">
                                    @if ($filter)
                                        @if ($resFilter == 'byAll')
                                        <button wire:click='pasienExportAll' class="btn btn-success btn-sm">Export</button>

                                        @elseif ($resFilter == 'byDate')
                                            <input type="date" wire:model='from'> sampai <input type="date" wire:model='to'>
                                            <button wire:click='pasienExportByDate' class="btn btn-success btn-sm"><i class="bi bi-check2-square"></i></button>
                                        @endif


                                    @endif
                                </div>
                             </div>

                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover">
                                    <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>No Rekamedis</th>
                                                <th>No Antrian</th>
                                                <th>Nama Pasien</th>
                                                <th>Nama KK</th>
                                                <th>Usia</th>
                                                <th>No KK</th>
                                                @if ($details)
                                                    <th>No KTP Pasien</th>
                                                    <th>Jaminan</th>
                                                    <th>No Jaminan</th>
                                                    <th>Jenis Kelamin</th>
                                                    <th>TTL</th>
                                                    <th>Alamat</th>
                                                    <th>Wilayah</th>
                                                @endif

                                            </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($data as $key => $item)
                                            <tr>
                                                <td>{{ $data->firstItem() + $key }}</td>
                                                <td>{{ $item->kode_paramedis }}</td>
                                                <td>{{ $item->no_antrian }}</td>
                                                <td>{{ $item->nama_pasien }}</td>
                                                <td>{{ $item->nama_kk }}</td>
                                                <td>{{ $item->usia }}</td>
                                                <td>{{ $item->no_kk }}</td>
                                                @if ($details)
                                                <td>{{ $item->no_ktp }}</td>

                                                    <td>{{ $item->jaminan->nama_jaminan }}</td>
                                                    <td>{{ $item->no_jaminan }}</td>
                                                    <td>{{ $item->jenis_kelamin }}</td>
                                                    <td>
                                                        {{ ucwords(strtolower($item->tempat_lahir)) }},
                                                        {{ Carbon\carbon::parse($item->tanggal_lahir)->format('d M Y') }}

                                                    </td>
                                                    <td>{{ $item->alamat }}</td>
                                                    <td>{{ $item->wilayah }}</td>
                                                @endif
                                                <td>

                                                </td>
                                            </tr>

                                        @empty

                                        <td colspan="14" class="text-center">Data not found</td>
                                    @endforelse
                                </tbody>
                                </table>
                            </div>

                            <div class="mt-3 mb-3">
                                {{ $data->links() }}
                            </div>

                               @elseif ($choice == 'dokter')
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <input type="text" wire:model='search' placeholder="Search by nama">
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
                                        <button class="btn btn-success btn-sm" wire:click='dokterExportAll'>Export</button>
                                    </div>
                                </div>

                                <p></p>

                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Nomor Induk Dokter</th>
                                            <th>Poli</th>
                                            @if ($details)
                                                <th>TTL</th>
                                                <th>Alamat</th>
                                            @endif

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($data as $key => $item)
                                            <tr>
                                                <td>{{ $data->firstItem() + $key }}</td>
                                                <td>{{ $item->nama_dokter }}</td>
                                                <td>
                                                    @if ($item->jenis_kelamin == 'L')
                                                        <span class="badge bg-primary">L</span>

                                                    @else
                                                        <span class="badge bg-success">P</span>
                                                    @endif
                                                </td>
                                                <td>{{ $item->nid }}</td>
                                                <td>{{ $item->poli->nama_poli }}</td>
                                                @if ($details)
                                                    <td>
                                                        {{ ucwords(strtolower($item->tempat_lahir)) }},
                                                        {{ Carbon\carbon::parse($item->tanggal_lahir)->format('d M Y') }}
                                                    </td>
                                                    <td>{{ $item->alamat }}</td>
                                                @endif

                                            </tr>
                                        @empty
                                        <td colspan="8" class="text-center">Data not found</td>
                                        @endforelse
                                    </tbody>
                                    </table>
                                </div>

                                <div>
                                    {{ $data->links() }}
                                </div>

                                @elseif ($choice == 'pendaftaran')

                                        <div class="d-flex justify-content-between">
                                            <div class="mt-3 mb-3">
                                                <input type="text" wire:model='search' placeholder="Search data {{ strtolower($title) }}">
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
                                            <div></div>
                                    </div>

                                    <div class="mt-1 mb-4 d-flex">
                                        @if (!$filter)
                                            <div>
                                                <button wire:click='openFormFilter' class="btn btn-success btn-sm">
                                                    <i class="bi bi-filter-right"></i>
                                                </button>
                                            </div>
                                        @else

                                            <div class="d-flex">
                                                <span style="margin-right:6px;" class="text-danger closed" wire:click='closeFormFilter'>
                                                    <i class="bi bi-x-square"></i>
                                                </span>
                                                <select wire:model='resFilter'>
                                                    <option value="" selected>Pilih</option>
                                                    <option value="byDate">By Date</option>
                                                    <option value="byAll">By All</option>
                                                </select>
                                            </div>

                                        @endif

                                        <div style="margin-left:5px;">
                                            @if ($filter)
                                                @if ($resFilter == 'byAll')
                                                <button class="btn btn-success btn-sm" wire:click='pendaftaranExportAll'>Export</button>

                                                @elseif ($resFilter == 'byDate')
                                                    <input type="date" wire:model='from'> sampai <input type="date" wire:model='to'>
                                                    <button wire:click='pendaftaranExportByDate' class="btn btn-success btn-sm"><i class="bi bi-check2-square"></i></button>
                                                @endif


                                            @endif
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
                                                    <th>Status</th>
                                                    @if ($details)
                                                        <th>Nama Dokter</th>
                                                        <th>Jenis Poli</th>
                                                    @endif

                                                </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($data as $key => $item)
                                                <tr>
                                                    <td>{{ $data->firstItem() + $key }}</td>
                                                    <td>{{ $item->pasien->no_antrian }}</td>
                                                    <td>{{ $item->no_rekammedis }}</td>
                                                    <td>{{ $item->pasien->nama_pasien }}</td>
                                                    <td>{{ $item->status_pasien }}</td>
                                                    @if ($details)
                                                        <td>{{ $item->dokter->nama_dokter }}</td>
                                                        <td>{{ $item->poli->nama_poli }}</td>
                                                    @endif
                                                    <td>

                                                    </td>
                                                </tr>

                                                @empty

                                                <td colspan="10" class="text-center">Data not found</td>
                                            @endforelse
                                        </tbody>
                                        </table>
                                    </div>

                                    <div>
                                        {{ $data->links() }}
                                    </div>

                                    @elseif ($choice == 'obat')


                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <select wire:model='rows'>
                                                <option value="5" selected>5</option>
                                                <option value="10" selected>10</option>
                                                <option value="15" selected>15</option>
                                                <option value="20" selected>20</option>
                                            </select>
                                        </div>

                                        <div>
                                            <button class="btn btn-success btn-sm" wire:click='obatExportAll'>Export</button>
                                        </div>
                                    </div>

                                    <p></p>

                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Pasien</th>
                                                <th>No RM</th>
                                                <th>Nama Obat</th>
                                                <th>Jumlah Obat</th>
                                                <th>Jenis Obat</th>
                                                <th>Jaminan</th>
                                                <th>Poli</th>
                                            </tr>
                                            {{-- <tr>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th>Biotik</th>
                                                <th>Antibiotik</th>
                                                <th>KIS</th>
                                                <th>ASKES</th>
                                                <th>LM-NIK</th>
                                                <th>Umun</th> --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                           @php
                                               $item_obat = null;
                                               $jenis_obat = null;
                                               $item = null;
                                           @endphp
                                           @forelse ($data as $key => $item)
                                            <tr>
                                                <td>{{ $data->firstItem() + $key }}</td>
                                                <td>{{ $item->pasien->nama_pasien }}</td>
                                                <td>{{ $item->pasien->kode_paramedis }}</td>
                                                <td>{{ $item->obat->nama_obat }}</td>
                                                <td>{{ $item->jumlah_obat }}</td>
                                                <td>{{ $item->jenis_obat }} </td>
                                                <td>{{ $item->pasien->jaminan->nama_jaminan }}</td>
                                                <td>{{ $item->poli->nama_poli }}</td>
                                                <input type="hidden" value="{{ $item_obat += $item->jumlah_obat }}">
                                            </tr>

                                            @empty
                                            <td class="text-center">Data Kosong .... </td>

                                           @endforelse
                                        </tbody>

                                        </table>
                                    </div>

                                    <div class="card card-body">
                                        Jumlah Resep Obat : {{ !is_null($item) ? $item->count() : $item }} <br>
                                        Jumlah Item Obat : {{ $item_obat  }} <br>
                                        Jenis Obat : <ul>
                                            @foreach ($data_jenis_obat as $d)
                                                <li>{{ $d->jenis_obat }} : {{ $d->total }}</li>
                                            @endforeach
                                        </ul>
                                        Jenis Jaminan : <ul>
                                            @foreach ($data_jenis_jaminan as $j)
                                                 <li>{{ $j->nama_jaminan }} : {{ $j->total }}</li>
                                            @endforeach
                                        </ul>
                                        Jenis Poli : <ul>
                                            @foreach ($data_jenis_poli as $p)
                                               <li> {{ $p->nama_poli }} : {{ $p->total }}</li>
                                            @endforeach
                                        </ul>

                                        </tfoot>
                                    </div>

                                    <div>
                                        {{ $data->links() }}
                                    </div>


                                    @elseif ($choice == 'lab')



                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <input type="text" wire:model='search' placeholder="Search data..">
                                            <select wire:model='rows'>
                                                <option value="5">5</option>
                                                <option value="10">10</option>
                                                <option value="15">15</option>
                                                <option value="20">20</option>
                                            </select>
                                        </div>
                                        <div>
                                            <button class="btn btn-success btn-sm" wire:click='labsExportAll'>Export</button>
                                        </div>
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
                                                    <th>Created At</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($data as $key => $item)
                                                    <tr>
                                                        <td>{{ $data->firstItem() + $key }}</td>
                                                        <td>{{ $item->no_rawat }}</td>
                                                        <td>{{ $item->no_rekammedis }}</td>
                                                        <td>{{ $item->pasien->nama_pasien }}</td>
                                                        <td>{{ $item->created_at }}</td>
                                                        <td>
                                                            <button wire:click='labsExportWithId({{$item->id}})' class="btn btn-primary btn-sm">
                                                                <i class="bi bi-file-earmark-spreadsheet-fill"></i>
                                                            </button>
                                                        </td>
                                                    </tr>

                                                    @empty
                                                        <td class="text-center" colspan="6">No Data Found</td>

                                                @endforelse
                                            </tbody>
                                        </table>

                                        <div class="form-group">
                                            {{ $data->links() }}
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

        <script src="{{ asset('assets/vendors/simple-datatables/simple-datatables.js') }}"></script>
        <script>
            // Simple Datatable
            let table1 = document.querySelector('#table');
            let dataTable = new simpleDatatables.DataTable(table);
        </script>


        <script src="{{  asset('assets/js/main.js') }}"></script>
    @endsection
</div>
