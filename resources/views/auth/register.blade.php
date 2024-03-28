@extends('layouts.main')
@section('title')
    Register
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
                                                        <h4 class="font-size-18">Register</h4>
                                                        <p class="text-muted">Please enter your details to start saving money today.</p>
                                                    </div>

                                                    <form method="POST" action="{{ route('register') }}"
                                                        class="auth-input">
                                                        @csrf

                                                        <div class="mb-2">                                                           
                                                            <input id="company" type="text"
                                                                class="form-control @error('company') is-invalid @enderror"
                                                                name="company" value="{{ old('company') }}" required
                                                                autocomplete="company" autofocus placeholder="Company Name">
                                                            @error('company')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>

                                                        <div class="mb-2">
                                                            <select id="industry_id" class="form-control @error('industry_id') is-invalid @enderror" name="industry_id" required>
                                                                <option value="" selected disabled>Industry</option>
                                                                @foreach ($industries as $industry)
                                                                    <option value="{{ $industry->id }}">{{ $industry->name }}</option>
                                                                @endforeach
                                                            </select>
                                                    
                                                            @error('industry_id')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>

                                                        <div class="mb-2">                                                           
                                                            <input id="name" type="text"
                                                                class="form-control @error('name') is-invalid @enderror"
                                                                name="name" value="{{ old('name') }}" required
                                                                autocomplete="name" autofocus placeholder="Enter name">
                                                            @error('name')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>

                                                        <div class="mb-2">
                                                           
                                                            <input id="email" type="email"
                                                                class="form-control @error('email') is-invalid @enderror"
                                                                name="email" value="{{ old('email') }}" required
                                                                autocomplete="email" placeholder="Enter email">
                                                            @error('email')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>


                                                        <div class="mb-3">
                                                            
                                                            <input type="password"
                                                                class="form-control @error('password') is-invalid @enderror"
                                                                name="password" required id="password-input"
                                                                placeholder="Enter password">
                                                            @error('password')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>

                                                        <div class="mb-3">
                                                            
                                                            <input type="password"
                                                                class="form-control @error('password') is-invalid @enderror"
                                                                name="password_confirmation" required id="password-confirm"
                                                                placeholder="Enter confirm password">
                                                        </div>

                                                        

                                                        <div class="mt-4">
                                                            <button class="btn btn-primary w-100"
                                                                type="submit">Register</button>
                                                        </div>

                                                       
                                                    </form>
                                                </div>

                                                <div class="mt-4 text-center">
                                                    <p class="mb-0">Already have an account ? <a href="{{ route('login') }}"
                                                            class="fw-medium text-primary"> Login</a> </p>
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
