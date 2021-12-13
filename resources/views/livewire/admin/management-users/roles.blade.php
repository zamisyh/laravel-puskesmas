<div>


    @section('title', 'Management - Roles')


    <div id="app">
        @include('livewire.admin.components.sidebar')
        <div id="main" class='layout-navbar'>
            @include('livewire.admin.components.header')
            <div id="main-content">

                <div class="page-heading">
                    <div class="page-title">
                        <div class="row">
                            <div class="col-12 col-md-6 order-md-1 order-last">
                                <h3>Management - Roles</h3>
                                <p class="text-subtitle text-muted">Hi, this is page for manajement Role</p>
                            </div>
                            <div class="col-12 col-md-6 order-md-2 order-first">
                                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Management
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">Roles
                                        </li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <section class="section">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Role</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <input type="text" wire:model='name_role' class="form-control @error('name_role') is-invalid @enderror" placeholder="Add mew role">
                                            @error('name_role')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <button wire:click.prevent='saveRole' wire:loading.remove class="btn btn-success btn-block">Save</button>
                                            <button wire:loading wire:target='saveRole' class="btn btn-success btn-block">Saving</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-8">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Data Role</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped">
                                                <thead class="bg-success text-white">
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Guard</th>
                                                        <th>Created At</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($dataRole as $role)
                                                        <tr>
                                                            <td>{{ $role->name }}</td>
                                                            <td>{{ $role->guard_name }}</td>
                                                            <td>{{ $role->created_at }}</td>
                                                            <td>
                                                                <button class="btn btn-danger btn-sm" wire:click.prevent='deleteRole({{ $role->id }})'>
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
