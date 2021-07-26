<div>

   @if ($printPage)
   <div class="card">
    <div class="card-body mt-3">
        <h4> Biodata Pasien - Pemeriksaan Laboratorium</h4>
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
                            <th>Hasil</th>
                            <th>Satuan</th>
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
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
            
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
                           <div class="col-12 col-md-6 order-md-1 order-last">
                               <h3>Laboratorium</h3>
                               <p class="text-subtitle text-muted">Hi, this is page for manage data laboratorium</p>
                           </div>
                           <div class="col-12 col-md-6 order-md-2 order-first">
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
                               <div class="card-body mt-3">
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
                                                       </tr>
                                                   @endforeach
                                               </tbody>
                                           </table>

                                           <div class="form-grup mb-3 mt-4">
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
                                                   <th>No Rawat</th>
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
                                                       <td>{{ $item->no_rawat }}</td>
                                                       <td>{{ $item->no_rekammedis }}</td>
                                                       <td>{{ $item->pasien->nama_pasien }}</td>
                                                       <td>{{ $item->created_at }}</td>
                                                       <td class="d-flex">
                                                           <button wire:click='openFormLab({{$item->id}})' class="btn btn-primary btn-sm">
                                                               <i class="bi bi-eye-fill"></i>
                                                           </button>
                                                           <button class="btn btn-danger btn-sm"
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
