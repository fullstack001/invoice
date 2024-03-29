@extends('layouts.master')
@section('title')
    Profile
@endsection
@section('page-title')
    Profile
@endsection
@section('body')

    <body data-sidebar="colored">
    @endsection
    @section('content')
        <div class="row">
            <div class="col-md-6">
                <div class="content-description mb-3">
                    This page allows you to update your avatar and personal details
                </div>
                <form action="{{ route('profile.update') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="user-avatar mb-3">
                        <img src="{{ auth()->user()->avatar ? URL::asset(auth()->user()->avatar) : URL::asset('assets/images/users/avatar.png') }} " class="img-fluid profile-avatar rounded-circle" alt="">
                        <input type="file" name="avatar" id="avatar" accept="image/*">
                    </div>

                    <div class="mb-2">                                                           
                        <input id="company" type="text"
                            class="form-control @error('company') is-invalid @enderror"
                            name="company" value="{{ $company }}" required
                            autocomplete="company" autofocus placeholder="Company Name">
                        @error('company')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>               

                    <div class="mb-2">                                                           
                        <input id="name" type="text"
                            class="form-control @error('name') is-invalid @enderror"
                            name="name" value="{{ Auth::user()->name }}" required
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
                            name="email" value="{{ Auth::user()->email }}" required
                            autocomplete="email" placeholder="Enter email" >
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>


                    <div class="mb-3">                        
                        <input type="password"
                            class="form-control @error('password') is-invalid @enderror"
                            name="password" id="password-input"
                            placeholder="New password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">                    
                        <input type="password"
                            class="form-control @error('password') is-invalid @enderror"
                            name="password_confirmation" id="password-confirm"
                            placeholder="Confirm New password">
                    </div>

                    <div class="mb-3">                    
                        <input type="password"
                            class="form-control @error('current_password') is-invalid @enderror"
                            name="current_password" id="current_password"
                            placeholder="Current password">
                    </div>                    

                    <div class="mt-4">
                        <button class="btn btn-primary w-100"
                            type="submit">Save Details</button>
                    </div>
                </form>
            </div>

            

        </div>
    @endsection
    @section('scripts')
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection
