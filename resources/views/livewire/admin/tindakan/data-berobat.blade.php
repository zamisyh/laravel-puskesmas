<div>

    @section('css')
        <link rel="stylesheet" href="{{ asset('assets/vendors/select2/select2.min.css') }}">
    @endsection

    @section('title', 'Tindakan - Data Berobat')


    @if ($openPagePrintRujukan)
    <center>
        <div class="">
            <img src="{{ asset('logo.ico') }}" height="80" width="80" class="mt-10">
            <h5 class="p-1">UPTD Puskesmas Perumnas 2</h5>
            <span>JL Belut Raya, No. 1, Kayuringin, <br> Bekasi Bekasi, Jawa Barat <br>Indonesia 17144. Phone: (021) 88954619</span>
        </div>
        <table class="table mt-2 table-bordered" border="3" style="width: 35%">

            <tr>
                <td style="font-weight: 700">Tanggal Pendaftaran</td>
                <td>{{ Carbon\carbon::parse($this->dataPrintRujukan->tanggal_daftar)->format('d-m-Y') }}</td>
            </tr>
            <tr>
                <td style="font-weight: 700">Jaminan / No Jaminan</td>
                <td>{{ $this->dataPrintRujukan->pasien->jaminan->nama_jaminan}} / {{ $this->dataPrintRujukan->no_jaminan }}</td>
            </tr>
            <tr>
                <td style="font-weight: 700">Nama / Umur</td>
                <td>{{ $this->dataPrintRujukan->pasien->nama_pasien }} / {{ $this->dataPrintRujukan->pasien->usia }} </td>
            </tr>
            <tr>
                <td style="font-weight: 700">TTL</td>
                <td>{{ Carbon\carbon::parse($this->dataPrintRujukan->pasien->tanggal_lahir)->format('d-m-Y') }}</td>
            </tr>
            <tr>
                <td style="font-weight: 700">Alamat</td>
                <td>{{ $this->dataPrintRujukan->pasien->alamat }}</td>
            </tr>
            <tr>
                <td style="font-weight: 700">Diagnosa</td>
                <td>
                    <ol>
                        @foreach ($dataTindakanPrintRujukan->diagnosaMany as $d)
                            <li> [ {{ $d->code }} ] {{ $d->nama_penyakit }}</li>
                        @endforeach
                    </ol>
                </td>
            </tr>
            <tr>
                <td style="font-weight: 700">Poli Tujuan</td>
                <td>{{ $this->dataPrintRujukan->poli->nama_poli }}</td>
            </tr>
            <tr>
                <td style="font-weight: 700">RS Tujuan</td>
                <td>{{ $this->rs_tujuan->nama_rumah_sakit }}</td>

            </tr>
            <tr>
                <td>TD : {{ $this->dataTindakanPrintRujukan->tekanan_darah}}</td>
                <td>TB : {{ $this->dataTindakanPrintRujukan->tinggi_badan }}</td>

            </tr>
            <tr>
                <td>BB : {{ $this->dataTindakanPrintRujukan->bb}}</td>
                <td>N : {{ $this->dataTindakanPrintRujukan->tekanan_nadi }}</td>

            </tr>
            <tr>
                <td>RR : {{ $this->dataTindakanPrintRujukan->rr }}</td>
                <td>LP : {{ $this->dataTindakanPrintRujukan->lp }}</td>
            </tr>
            <tr>
                <td style="font-weight: 700">TTD Dokter</td>
                <td></td>
            </tr>
        </table>
    </center>
    @elseif($openPagePrintResepObat)
    <center>
        <div class="">
            <img src="{{ asset('logo.ico') }}" height="80" width="80" class="mt-10">
            <h5 class="p-1">UPTD Puskesmas Perumnas 2</h5>
            <span>JL Belut Raya, No. 1, Kayuringin, <br> Bekasi Bekasi, Jawa Barat <br>Indonesia 17144. Phone: (021) 88954619</span>
        </div>
        <table class="table mt-2 table-bordered" border="3" style="width: 30%">
            <tr>
                <td style="font-weight: 700">Riwayat Alergi Obat</td>
                <td>
                    @if ($this->dataPrintAlergiObat->alergi_obat == 1)
                        {{ $this->dataPrintAlergiObat->keterangan_alergi }}

                    @else
                        -
                    @endif
                </td>
            </tr>
            <tr>
                <td style="font-weight: 700">No. Urut</td>
                <td></td>
            </tr>
            <tr>
                <td style="font-weight: 700">Nama dr</td>
                <td>{{ $this->dataPrintResepObatPasien->dokter->nama_dokter }}</td>
            </tr>
            <tr>
                <td style="font-weight: 700">Tanggal</td>
                <td>{{ Carbon\carbon::parse($this->dataPrintResepObatPasien->tanggal_daftar)->format('d-m-Y') }}</td>
            </tr>
            <tr>
                <td style="font-weight: 700">Nama Obat / Jumlah</td>
                <td>
                    <ul>
                        @foreach ($this->dataPrintResepObat as $item)
                            <li>{{ $item->obat->nama_obat }} / {{ $item->jumlah_obat }}</li>

                        @endforeach
                    </ul>
                </td>
            </tr>
            <tr>
                <td style="font-weight: 700">Nama / JK</td>
                <td>
                    {{ $this->dataPrintResepObatPasien->pasien->nama_pasien }} /
                    {{ $this->dataPrintResepObatPasien->pasien->jenis_kelamin }}

                </td>
            </tr>
            <tr>
                <td style="font-weight: 700">No. RM</td>
                <td>{{ $this->dataPrintResepObatPasien->pasien->kode_paramedis }}</td>
            </tr>
            <tr>
                <td style="font-weight: 700">Umur</td>
                <td>{{ $this->dataPrintResepObatPasien->pasien->usia }}</td>
            </tr>
            <tr>
                <td style="font-weight: 700">BB</td>
                <td>{{ $this->dataPrintResepObatTindakan->bb }} kg</td>
            </tr>
            <tr>
                <td style="font-weight: 700">Diagnosa</td>
                <td>
                    <ul>
                        @foreach ($this->dataPrintResepObatTindakan->diagnosaMany as $d)
                            <li>{{ $d->nama_penyakit }}</li>
                        @endforeach
                    </ul>
                </td>
            </tr>
            <tr>
                <td style="font-weight: 700">Jaminan</td>
                <td>{{ $this->dataPrintResepObatPasien->pasien->jaminan->nama_jaminan }}</td>
            </tr>
        </table>
    </center>
    @elseif($openPrintPageTindakan)
    <div class="container p-5">
        <div class="d-flex justify-content-between">
            <div>
                Nama : {{ $nama_pasien }} <br />
                Usia / TTL : {{ $usia }} /
                            {{ Carbon\carbon::parse($tl)->format('d-m-Y') }} <br />
                Jenis Kelamin : {{ $jk }}

            </div>
            <div>
                Hubungan Dengan KK : {{ ucwords(strtolower($hub)) }} <br />
                Kartu Jaminan Kesehatan : {{ $jmn }} <br />
                No RM : {{ $no_rekamedis }} <br />
                Pekerjaan :
            </div>
        </div>

        <div class="mt-3">
            <table class="table table-bordered">
                <thead class="text-white bg-success">
                    <tr>
                        <th rowspan="2">Tanggal Berobat</th>
                        <th colspan="4">
                            <center>
                                Catatan Pemeriksaan Pasien Terintegrasi
                            </center>
                        </th>
                        <th rowspan="2">TTD</th>
                    </tr>
                    <tr>

                        <th><center>Anamnesis</center></th>
                        <th><center>Pemeriksaan Fisik dan Penunjang</center></th>
                        <th><center>Diagnosa</center></th>
                        <th><center>Rencana Layanan</center></th>

                    </tr>
                </thead>
                <tbody>

                    <tr>
                        <td>{{ $dataPrintCetakTindakan->created_at }}</td>
                        <td>{{ $dataPrintCetakTindakan->hasil_periksa }}</td>
                        <td>{{ $dataPrintCetakTindakan->cek_fisik }} - {{ $dataPrintCetakTindakan->penunjang }}</td>
                        <td>
                            <ul>
                                @foreach ($dataPrintCetakTindakan->diagnosaMany as $item)
                                    <li>[{{ $item->code }}] - {{ $item->nama_penyakit }}</li>
                                @endforeach
                            </ul>
                        </td>
                        <td>{{ $dataPrintCetakTindakan->rencana_pengobatan }}</td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    @elseif($openPrintPageTindakanAll)
    <div class="container p-5">
        <div class="d-flex justify-content-between">
            <div>
                Nama : {{ $nama_pasien }} <br />
                Usia / TTL : {{ $usia }} /
                            {{ Carbon\carbon::parse($tl)->format('d-m-Y') }} <br />
                Jenis Kelamin : {{ $jk }}

            </div>
            <div>
                Hubungan Dengan KK : {{ ucwords(strtolower($hub)) }} <br />
                Kartu Jaminan Kesehatan : {{ $jmn }} <br />
                No RM : {{ $no_rekamedis }} <br />
                Pekerjaan :
            </div>
        </div>

        <div class="mt-3">
            <table class="table table-bordered">
                <thead class="text-white bg-success">
                    <tr>
                        <th rowspan="2">Tanggal Berobat</th>
                        <th colspan="4">
                            <center>
                                Catatan Pemeriksaan Pasien Terintegrasi
                            </center>
                        </th>
                        <th rowspan="2">TTD</th>
                    </tr>
                    <tr>

                        <th><center>Anamnesis</center></th>
                        <th><center>Pemeriksaan Fisik dan Penunjang</center></th>
                        <th><center>Diagnosa</center></th>
                        <th><center>Rencana Layanan</center></th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataPrintCetakTindakan as $item)
                        <tr>
                            <td>{{ $item->created_at }}</td>
                            <td>{{ $item->hasil_periksa }}</td>
                            <td>{{ $item->cek_fisik }} - {{ $item->penunjang }}</td>
                            <td>
                                <ul>
                                    @foreach ($item->diagnosaMany as $d)
                                        <li>[{{ $d->code }}] - {{ $d->nama_penyakit }}</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>{{ $item->rencana_pengobatan }}</td>
                            <td></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @else
        <div id="app">
            @include('livewire.admin.components.sidebar')
            <div id="main" class='layout-navbar'>
                @include('livewire.admin.components.header')
                <div id="main-content">

                    <div class="page-heading">
                        <div class="page-title">
                            <div class="row">
                                <div class="order-last col-12 col-md-6 order-md-1">
                                    <h3>Tindakan - Data Berobat</h3>
                                    <p class="text-subtitle text-muted">Hi, this is page for manajement data Berobat</p>
                                </div>
                                <div class="order-first col-12 col-md-6 order-md-2">
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
                                                        <td>No Antrian</td>
                                                        <td>{{ $no_antrian }}</td>
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
                                                        <td> <button type="button" wire:click='cetakRujukanLab' class="btn btn-primary btn-sm">Cetak Rujukan Lab</button></td>
                                                    </tr>
                                                    <tr>
                                                        <td> <button wire:click='openFormInputTindakan' type="button" class="btn btn-success btn-sm">Input Tindakan</button></td>
                                                        <td> <button type="button" wire:click='cetakTindakan' class="btn btn-success btn-sm">Cetak Rekamedis</button></td>
                                                    </tr>
                                                    <tr>
                                                        <td> <button wire:click='openFormInputResepObat' type="button" class="btn btn-info btn-sm">Input Resep Obat</button></td>
                                                        <td> <button type="button" wire:click='cetakResepObat' class="btn btn-info btn-sm">Cetak Resep Obat</button></td>
                                                    </tr>
                                                    <tr>
                                                        <td> <button wire:click='openFormInputRujujan' type="button" class="btn btn-warning btn-sm">Input Rujukan</button></td>
                                                        <td> <button type="button" wire:click='cetakRujukan' class="btn btn-warning btn-sm">Cetak Rujukan</button></td>
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

                                                <div class="mt-3 mb-3">
                                                        @if ($openFormAddLab)
                                                            <div>
                                                                <div class="form-group">
                                                                    <label for="keterangan">Keterangan</label>
                                                                    <input wire:model='keterangan_lab' type="text" class="form-control" placeholder="Masukkan keterangan">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="nilai">Nilai</label>
                                                                    <input wire:model='nilai_lab' type="text" class="form-control" placeholder="Masukkan nilai">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="satuan">Satuan</label>
                                                                    <input wire:model='satuan_lab' type="text" class="form-control" placeholder="Masukkan satuan">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="nilai_rujukan">Nilai Rujukan</label>
                                                                    <input wire:model='nilai_rujukan_lab' type="text" class="form-control" placeholder="Masukkan nilai rujukan">
                                                                </div>
                                                            </div>

                                                            <div class="mt-3">
                                                                <span role="button" class="text-primary" wire:click='closeFormInputAddLab'>Tutup</span>
                                                            </div>
                                                        @endif

                                                        @if (!$openFormAddLab)
                                                            <span role="button" class="text-primary" wire:click='openFormInputAddLab'>Tambah Keterangan Baru</span>
                                                        @endif
                                                </div>

                                                <div class="mt-3">
                                                    <button class="btn btn-success">Submit</button>
                                                </div>
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
                                    <div class="mt-4 card-body">

                                        <button wire:click="cetakPrintTindakanAll({{ $no_rawat }})" class="mb-4 btn btn-primary">Cetak Riwayat Tindakan</button>

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
                                                        <th>Tekanan Darah</th>
                                                        <th>Tekanan Nadi</th>
                                                        <th>HR</th>
                                                        <th>RR</th>
                                                        <th>LP</th>
                                                        <th>TB</th>
                                                        <th>BB</th>
                                                        <th>IMT</th>
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
                                                            <td>{{ $item->cek_fisik }}</td>
                                                            <td>{{ $item->temperatur }}</td>
                                                            <td>{{ $item->tekanan_darah }}</td>
                                                            <td>{{ $item->tekanan_nadi }}</td>
                                                            <td>{{ $item->hr }}</td>
                                                            <td>{{ $item->rr }}</td>
                                                            <td>{{ $item->lp }}</td>
                                                            <td>{{ $item->tinggi_badan }}</td>
                                                            <td>{{ $item->bb }}</td>
                                                            <td>{{ $item->imt }}</td>
                                                            <td>{{ $item->penunjang }}</td>
                                                            <td>{{ $item->rencana_pengobatan }}</td>
                                                            <td class="d-flex">
                                                                <button wire:click.prevent='deleteDataRiwayatTindakan({{ $item->id }})' style="margin-left: 5px" class="btn btn-danger btn-sm">
                                                                    <i class="bi bi-trash-fill"></i>
                                                                </button>
                                                                <button wire:click='cetakPrintTindakan({{ $item->id }})' class="ml-3 btn btn-primary btn-sm" style="margin-left: 3px">
                                                                    <i class="bi bi-printer"></i>
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
                                    <div class="mt-4 card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Nama Obat</th>
                                                        <th>Jenis</th>
                                                        <th>Dosis</th>
                                                        <th>Created At</th>
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
                                                        <td>{{ Carbon\carbon::parse($item->created_at)->format('d-m-Y') }}</td>
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
                                                @forelse ($data_berobat as $key => $item)
                                                    <tr>
                                                        <td>{{ $data_berobat->firstItem() + $key }}</td>
                                                        <td>{{ $item->pasien->no_antrian }}</td>
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
    @endif

    @section('js')

        <script src="{{ asset('assets/vendors/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/vendors/select2/select2.min.js') }}"></script>


        <script src="{{  asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
        <script src="{{  asset('assets/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{  asset('assets/js/main.js') }}"></script>
    @endsection
</div>
