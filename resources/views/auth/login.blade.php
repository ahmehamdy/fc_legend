@extends('layouts.app')

@section('title', 'FC Legend - Member Login')
{{-- @section('page', 'login') --}}

@section('content')
    <div class="container py-5 my-5">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card bg-dark text-white border-secondary p-4 p-md-5 shadow-lg">
                    <div class="text-center mb-4">
                        <a class="heading-font display-4 text-white text-decoration-none" href="/">FC <span
                                class="text-danger">LEGEND</span></a>
                        <h3 class="heading-font fs-3 text-secondary mt-2">ACCOUNT LOGIN</h3>
                    </div>

                    <div id="login-alert"></div>
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <form action="{{ route('login') }}" id="login-form">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="email" class="form-label text-light fw-medium"><i
                                    class="fas fa-envelope me-2 text-danger"></i> Email Address</label>
                            <input type="email" class="form-control bg-black text-white border-secondary" id="email"
                                name="email" placeholder="name@example.com" required autocomplete="email">
                        </div>

                        <div class="form-group mb-4">
                            <label for="password" class="form-label text-light fw-medium"><i
                                    class="fas fa-lock me-2 text-danger"></i> Password</label>
                            <input type="password" class="form-control bg-black text-white border-secondary" id="password"
                                name="password" placeholder="••••••••" required autocomplete="current-password">
                        </div>

                        <button type="submit" class="btn btn-danger btn-lg w-100 mb-3">
                            <i class="fas fa-sign-in-alt me-2"></i> Log In
                        </button>
                        <a href="{{ route('google.login') }}" class="btn btn-danger btn-lg w-100 mb-3">
                            <i class="fab fa-google me-2"></i>
                            Continue with Google
                        </a>

                        <div class="text-center text-secondary small">
                            Don't have an account yet? <a href="/register-view"
                                class="text-danger text-decoration-none">Register
                                here</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
