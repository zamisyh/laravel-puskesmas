<div>

   @if ($printPage)
    <div class="container mt-10">
        <div class="d-flex justify-content-between">
            <div>
                <img src="{{ asset('patriot.png') }}" height="100px" alt="">
            </div>
            <div>
                <center>
                    <h6>PEMERINTAH KOTA BEKASI</h6>
                    <h4>DINAS KESEHATAN KOTA BEKASI</h4>
                    <h5>UPTD PUSKESMAS PERUMNAS II</h5>
                    <span>Jln. Belut Raya No. 1 - Kayuringin Jaya - Bekasi Selatan - Kayuringin Jaya - Kota Bekasi
                        <br> Telp : (021)-8945-1520
                    </span>
                </center>
            </div>
            <div>
                <img src="{{ asset('logo2.png') }}" height="100px" alt="">
            </div>
        </div>
        <hr>
        <div class="d-flex justify-content-between">
            <div class="col-lg-8 w-50">
               <table class="table table-bordered table-xs table-condensed">
                   <tr>
                        <td> No. Laboratorium</td>
                        <td></td>
                   </tr>
                   <tr>
                       <td>Nama</td>
                       <td>{{ ucwords(strtolower($nama_pasien)) }}</td>
                   </tr>
                   <tr>
                       <td>Umur</td>
                       <td>{{ $data_pasien->pasien->usia }}</td>
                   </tr>
                   <tr>
                       <td>Alamat</td>
                       <td>{{ $data_pasien->pasien->alamat }}</td>
                   </tr>
                   <tr>
                       <td>No. RM</td>
                       <td>{{ $data_pasien->pasien->kode_paramedis }}</td>
                   </tr>
                   <tr>
                       <td>Jaminan Kesehatan</td>
                       <td>{{ $data_pasien->pasien->jaminan->nama_jaminan }}</td>
                   </tr>
               </table>
            </div>
            <div class="col-lg-4 w-50">
              <table class="table table-bordered table-condensed">
                  <tr>
                      <td>Dokter Pengirim</td>
                      <td></td>
                  </tr>
                  <tr>
                      <td>Asal Poli</td>
                      <td></td>
                  </tr>
                   <tr>
                       <td>Tanggal</td>
                       <td>{{  Carbon\carbon::parse($data_pasien->created_at)->format('d/m/y')  }}</td>
                   </tr>
              </table>
            </div>
        </div>
        <hr>
        <h3 class="text-center">HASIL PEMERIKSAAN</h3>
        <center>
           <div style="height: 40px; width: 50%; border: 1px; border-style:solid;">
               <span style="margin-left: -35%; line-height:40px;">Waktu Pengambilan Sampel : </span>
           </div>
        </center>
        <div class="mt-3 table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="text-white bg-success">
                    <tr>
                        <th>No</th>
                        <th>Keterangan</th>
                        <th>Hasil</th>
                        <th>Satuan</th>
                        <th>Nilai Rujukan</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($data_pasien->jenis_laboratorium as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->keterangan }}</td>
                            <td>
                                @if (!is_null($item->pivot->hasil))

                                    @if (!$openUpdateHasil)
                                        {{ $item->pivot->hasil }}
                                    @else
                                         <input type="text" wire:model='hasil.{{ $item->id }}' placeholder="Masukkan {{ $item->keterangan }}">
                                    @endif
                                @else
                                     <input type="text" wire:model='hasil.{{ $item->id }}' placeholder="Masukkan {{ $item->keterangan }}">
                                @endif
                            </td>
                            <td>{{ $item->satuan }}</td>
                            <td>{{ $item->nilai_rujukan }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>

    </div>
   @else
   @section('title', 'Laboratorium')

   @section('css')
       <style type="text/css">
           .edit:hover{
               cursor:pointer;
           }


       </style>
   @endsection

   <div id="app">
       @include('livewire.admin.components.sidebar')
       <div id="main" class='layout-navbar'>
           @include('livewire.admin.components.header')
           <div id="main-content">

               <div class="page-heading">
                   <div class="page-title">
                       <div class="row">
                           <div class="order-last col-12 col-md-6 order-md-1">
                               <h3>Laboratorium</h3>
                               <p class="text-subtitle text-muted">Hi, this is page for manage data laboratorium</p>
                           </div>
                           <div class="order-first col-12 col-md-6 order-md-2">
                               <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                   <ol class="breadcrumb">
                                       <li class="breadcrumb-item"><a href="{{ route('dash.home') }}">Dashboard</a></li>
                                       <li class="breadcrumb-item active" aria-current="page">Laboratorium
                                       </li>
                                   </ol>
                               </nav>
                           </div>
                       </div>
                   </div>
                   <section class="section">
                       @if ($openLab)
                           <div class="card">
                               <div class="card-header bg-success">
                                   <h4 class="text-white">Biodata Pasien - Pemeriksaan Laboratorium</h4>
                               </div>
                               <div class="mt-3 card-body">
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
                                           <td>{{ $nama_pasien }}</td>
                                       </tr>
                                   </table>

                                   <div class="mt-4 mb-3">
                                       <h4>Hasil Rujukan Lab</h4>
                                       <div class="table-responsive">
                                           <table class="table table-bordered table-hover">
                                               <thead>
                                                   <tr>
                                                       <th>No</th>
                                                       <th>Keterangan</th>
                                                       <th>Hasil <span class="edit" style="margin-left:30px;" wire:click='openInputUpdateHasil'><i class="bi bi-pencil-square"></i></span></th>
                                                       <th>Satuan</th>
                                                       <th>Nilai Rujukan</th>
                                                   </tr>
                                               </thead>
                                               <tbody>

                                                  @php
                                                      $data = null;
                                                  @endphp

                                                   @foreach ($data_pasien->jenis_laboratorium as $item)
                                                       <tr>
                                                           <td>{{  $data = $loop->iteration }}</td>
                                                           <td>{{ $item->keterangan }}</td>
                                                           <td>
                                                               @if (!is_null($item->pivot->hasil))

                                                                   @if (!$openUpdateHasil)
                                                                       {{ $item->pivot->hasil }}
                                                                   @else
                                                                        <input type="text" wire:model='hasil.{{ $item->id }}' placeholder="Masukkan {{ $item->keterangan }}">
                                                                   @endif
                                                               @else
                                                                    <input type="text" wire:model='hasil.{{ $item->id }}' placeholder="Masukkan {{ $item->keterangan }}">
                                                               @endif
                                                           </td>
                                                           <td>{{ $item->satuan }}</td>
                                                           <td>{{ $item->nilai_rujukan }}</td>
                                                       </tr>
                                                   @endforeach

                                                   @foreach ($data_lab_tambahan as $key => $item)
                                                       <tr>
                                                           <td>{{ $data + 1 + $key }}</td>
                                                           <td>{{ $item->keterangan }}</td>
                                                           <td>{{ $item->nilai }}</td>
                                                           <td>{{ $item->satuan }}</td>
                                                           <td>{{ $item->nilai_rujukan }}</td>
                                                       </tr>
                                                   @endforeach
                                               </tbody>
                                           </table>

                                           <div class="mt-4 mb-3 form-grup">
                                               <button class="btn btn-success" wire:click='refreshData'><i class="bi bi-arrow-repeat"></i> Refresh</button>
                                               <button class="btn btn-success" wire:click='openPrint({{ $data_pasien->id }})'><i class="bi bi-printer-fill"></i> Print</button>

                                           </div>
                                       </div>

                                   </div>
                               </div>
                           </div>
                       @else
                           <div class="card">
                               <div class="card-header">
                                   <h4 class="card-title">Data Laboratorium</h4>
                               </div>

                               <div class="card-body">
                                   <div class="mb-4">
                                       <input type="text" wire:model='search' placeholder="Search data..">
                                       <select wire:model='pageSize'>
                                           <option value="5">5</option>
                                           <option value="10">10</option>
                                           <option value="15">15</option>
                                           <option value="20">20</option>
                                       </select>
                                   </div>
                                   <div class="table-responsive">
                                       <table class="table table-bordered table-striped table-hover">
                                           <thead>
                                               <tr>
                                                   <th>No</th>
                                                   <th>No Antrian</th>
                                                   <th>No Rekamedis</th>
                                                   <th>Nama Pasien</th>
                                                   <th>Created At</th>
                                                   <th>Actions</th>
                                               </tr>
                                           </thead>
                                           <tbody>
                                               @forelse ($data_lab as $key => $item)
                                                   <tr>
                                                       <td>{{ $data_lab->firstItem() + $key }}</td>
                                                       <td>{{ $item->pasien->no_antrian }}</td>
                                                       <td>{{ $item->no_rekammedis }}</td>
                                                       <td>{{ $item->pasien->nama_pasien }}</td>
                                                       <td>{{ $item->created_at }}</td>
                                                       <td class="d-flex">
                                                           <button wire:click='openFormLab({{$item->id}})' class="btn btn-primary btn-sm">
                                                               <i class="bi bi-eye-fill"></i>
                                                           </button>
                                                           <button wire:click='deleteLab({{ $item->id }})' class="btn btn-danger btn-sm"
                                                           style="margin-left: 4px">
                                                               <i class="bi bi-trash"></i>
                                                           </button>
                                                       </td>
                                                   </tr>

                                                   @empty
                                                       <td class="text-center" colspan="6">No Data Found</td>

                                               @endforelse
                                           </tbody>
                                       </table>

                                       <div class="form-group">
                                           {{ $data_lab->links() }}
                                       </div>
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
       <script src="{{  asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
       <script src="{{  asset('assets/js/bootstrap.bundle.min.js') }}"></script>

       <script src="{{  asset('assets/js/main.js') }}"></script>
   @endsection
   @endif
</div>
