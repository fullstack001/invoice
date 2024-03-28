@extends('layouts.main')
@section('title')
    Login
@endsection
@section('content')
    <div class="banner d-flex align-items-center min-vh-100">
     
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="auth-full-page-content d-flex min-vh-100 py-sm-5 py-4">
                        <div class="w-100">
                            <div class="d-flex flex-column h-100 py-0 py-xl-3">                               

                                <div class="my-auto overflow-hidden">
                                    <div class="row g-0">                                       

                                        <div class="col-lg-6">
                                            <div class="p-lg-5 p-4">
                                                <div>
                                                    <div class="mt-1">
                                                        <h4 class="font-size-18">Login</h4>
                                                        <p class="text-muted">Please enter your details to login.</p>
                                                    </div>

                                                    <form method="POST" action="{{ route('login') }}" class="auth-input">
                                                        @csrf
                                                        <div class="mb-2">
                                                            <input id="email" type="email"
                                                                class="form-control @error('email') is-invalid @enderror"
                                                                name="email" value="{{ old('email', 'admin@themesbrand.com') }}" required
                                                                autocomplete="email" autofocus>
                                                            @error('email')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>

                                                        <div class="mb-3">
                                                            <input type="password"
                                                                class="form-control @error('password') is-invalid @enderror"
                                                                placeholder="Enter password" id="password-input"
                                                                name="password" required autocomplete="current-password"
                                                                value="12345678">
                                                            @error('password')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>

                                                        <div class="form-check d-flex justify-content-between">
                                                            <div>
                                                                <input class="form-check-input" type="checkbox"
                                                                    name="remember" id="remember"
                                                                    {{ old('remember') ? 'checked' : '' }}>
                                                                <label class="form-check-label" for="remember">Remember
                                                                    me</label>
                                                            </div>
                                                            <a href="{{ route('password.update') }}" class="text-end">Forget Password?</a>
                                                        </div>

                                                        <div class="mt-4">
                                                            <button class="btn btn-primary w-100" type="submit">Sign
                                                                In</button>
                                                        </div>

                                                     
                                                    </form>
                                                </div>

                                                <div class="mt-4 text-center">
                                                    <p class="mb-0">Not Registered ? <a
                                                            href="{{ route('register') }}" class="fw-medium text-primary">
                                                            Register </a> </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end card -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
    </div>
@endsection
@section('scripts')
    <!-- App js -->
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
