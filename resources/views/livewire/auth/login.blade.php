<div>

    @section('title', 'Login Page')
    @section('css')
        <link rel="stylesheet" href="{{ asset('assets/css/pages/auth.css') }}">
    @endsection


    <div id="auth">

        <div class="d-flex justify-content-center">
            <div class="col-lg-6 col-12 m-auto">
                <div id="auth-left">

                    <h1 class="auth-title">Sign in</h1>
                    <p class="auth-subtitle mb-5">Log in with your data that you entered during registration.</p>
                    @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                    <div class="form-group position-relative has-icon-left mb-4">
                        <input wire:model='email' type="email" class="form-control form-control-xl @error('email') is-invalid @enderror" placeholder="Email">
                        <div class="form-control-icon">
                            <i class="bi bi-envelope"></i>
                        </div>
                    </div>
                    @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                    <div class="form-group position-relative has-icon-left mb-4">
                        <input wire:model='password' type="password" class="form-control form-control-xl @error('password') is-invalid @enderror" placeholder="Password">
                        <div class="form-control-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                    </div>
                    <div class="form-check form-check-lg d-flex align-items-end">
                        <input class="form-check-input me-2" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label text-gray-600" for="flexCheckDefault">
                            Keep me logged in
                        </label>
                    </div>
                    <button wire:click.prevent='signinAction' wire:loading.remove class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Sign in</button>
                    <button wire:loading wire:target='signinAction' type="button" disabled class="btn btn-primary btn-block btn-lg shadow-lg mt-5">
                        <span class="spinner-border" role="status"
                        aria-hidden="true"></span>
                    </button>

                    @if ($redirect)
                        <script>
                            setTimeout(function () {
                                window.location.href = "{{ route('dash.home') }}";
                            }, 3000);
                        </script>

                    @endif

                    @if (Auth::check())
                        <script>
                            window.location.href = "{{ route('dash.home') }}";
                        </script>
                    @endif


                </div>
            </div>
        </div>

    </div>
</div>
