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
                                <h3>Management - Users</h3>
                                <p class="text-subtitle text-muted">Hi, this is page for manajement Users</p>
                            </div>
                            <div class="col-12 col-md-6 order-md-2 order-first">
                                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Management
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">Users
                                        </li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <section class="section">
                        <div class="card">
                            @if ($formCreateUser)

                                <div class="card-header">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h4>Create new Users</h4>
                                        </div>
                                        <div>
                                            <button wire:click='closeFormCreateUser' class="btn btn-primary btn-sm">X</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <form wire:submit.prevent='createUser'>

                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" wire:model.lazy='name' class="form-control @error('name') is-invalid @enderror" placeholder="Input your name">
                                            @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="text" wire:model.lazy='email' class="form-control @error('email') is-invalid @enderror" placeholder="Input your email">
                                            @error('email')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="role">Role</label>
                                            <select wire:model.lazy='role' class="form-control @error('role') is-invalid @enderror">
                                                <option value="" selected>Choose</option>
                                                @foreach ($data_role as $role)
                                                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('role')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password" wire:model.lazy='password' class="form-control @error('password') is-invalid @enderror" placeholder="Input your password">
                                            @error('password')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="confirm_password">Confirm Password</label>
                                            <input type="password" wire:model.lazy='confirm_password' class="form-control @error('confirm_password') is-invalid @enderror" placeholder="Input your confirm password">
                                            @error('confirm_password')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>


                                        <button class="btn btn-success">Submit</button>

                                    </form>
                                </div>

                            @else

                                <div class="card-header">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h4>Data Users</h4>
                                        </div>
                                        <div>
                                            <button wire:click='openFormCreateUser' class="btn btn-primary">Create User</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Role</th>
                                                    <th>Created At</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($data_user as $item)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ ucwords(strtolower($item->name)) }}</td>
                                                        <td>{{ $item->email }}</td>
                                                        <td>{{ $item->getRoleNames()[0] }}</td>
                                                        <td>{{ $item->created_at }}</td>
                                                        <td>
                                                            <button wire:click.prevent='deleteUser({{ $item->id }})' class="btn btn-danger btn-sm">
                                                                <i class="bi bi-trash-fill"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
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
