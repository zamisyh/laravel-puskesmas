<div>


    @section('css')
        <link rel="stylesheet" href="{{ asset('assets/vendors/select2/select2.min.css') }}">
    @endsection

    @section('title', 'Perbaikan Gizi')

    <div id="app">
        @include('livewire.admin.components.sidebar')
        <div id="main" class='layout-navbar'>
            @include('livewire.admin.components.header')
            <div id="main-content">

                <div class="page-heading">
                    <div class="page-title">
                        <div class="row">
                            <div class="col-12 col-md-6 order-md-1 order-last">
                                <h3>Perbaikan Gizi</h3>
                                <p class="text-subtitle text-muted">Hi, this is page for manajement data Perbaikan Gizi</p>
                            </div>
                            <div class="col-12 col-md-6 order-md-2 order-first">
                                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{ route('dash.home') }}">Dashboard</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Tindakan
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">Perbaikan Gizi
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
                                        <h4>{{ $perbaikanGiziId ? 'Update' : 'Create' }} Perbaikan Gizi</h4>
                                        <div>
                                            <button wire:click='closeFormCreatePerbaikanGizi' class="btn btn-sm btn-primary">X</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">
                                   @include('livewire.admin.components.perbaikan-gizi')
                                </div>

                            @else

                                <div class="card-header">
                                    <div class="d-flex justify-content-between">
                                        <h4>Data Perbaikan Gizi</h4>
                                        <div>
                                            <button wire:click='openFormCreatePerbaikanGizi' class="btn btn-sm btn-primary">Tambah Data</button>
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
                                                <th>Nama Pasien</th>
                                                <th>Terapi</th>   
                                                <th>Tanggal Terapi</th> 
                                                <th>Hasil</th>
                                                <th>Actions</th>
                                            </tr>   
                                        </thead>
                                        <tbody>
                                            @forelse ($perbaikan_gizis as $key => $item)
                                                <tr>
                                                    <td>{{ $perbaikan_gizis->firstItem() + $key }}</td>
                                                    <td>{{ $item->pasien->nama_pasien }}</td>
                                                    <td>{{ $item->terapi }}</td>  
                                                    <td>{{ Carbon\carbon::parse($item->tanggal)->format('d M Y') }}</td>  
                                                    <td>{{ $item->hasil }}</td>
                                                    
                                                    <td class="d-flex">
                                                        <button wire:click="openFormUpdatePerbaikanGizi({{ $item->id }})" class="btn btn-primary btn-sm">
                                                            <i class="bi bi-pencil-square"></i>
                                                        </button>
                                                        <button wire:click.prevent='deletePerbaikanGizi({{ $item->id }})' style="margin-left: 5px" class="btn btn-danger btn-sm">
                                                            <i class="bi bi-trash-fill"></i>
                                                        </button>
                                                    </td>
                                                </tr>   
                                            @empty
                                            <td colspan="8" class="text-center">Data not found</td>
                                            @endforelse
                                        </tbody>
                                        </table>
                                    </div>

                                    <div>
                                        {{ $perbaikan_gizis->links() }}
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

        <script src="{{ asset('assets/vendors/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/vendors/select2/select2.min.js') }}"></script>


        <script src="{{  asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
        <script src="{{  asset('assets/js/bootstrap.bundle.min.js') }}"></script>

        <script src="{{  asset('assets/js/main.js') }}"></script>
    @endsection
</div>
