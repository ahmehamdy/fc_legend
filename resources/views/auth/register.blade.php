@extends('layouts.app')

@section('title', 'FC Legend - Member Registration')
@section('page', 'register')

@section('content')
    <div class="container py-5 my-5">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card bg-dark text-white border-secondary p-4 p-md-5 shadow-lg">
                    <div class="text-center mb-4">
                        <a class="heading-font display-4 text-white text-decoration-none" href="/">FC <span
                                class="text-danger">LEGEND</span></a>
                        <h3 class="heading-font fs-3 text-secondary mt-2">CREATE AN ACCOUNT</h3>
                    </div>

                    <div id="register-alert"></div>

                    <form id="register-form" action="{{ route('register') }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="name" class="form-label text-light fw-medium"><i
                                    class="fas fa-user me-2 text-danger"></i> Full Name</label>
                            <input type="text" class="form-control bg-black text-white border-secondary" id="name"
                                name="name" placeholder="John Doe" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="email" class="form-label text-light fw-medium"><i
                                    class="fas fa-envelope me-2 text-danger"></i> Email Address</label>
                            <input type="email" class="form-control bg-black text-white border-secondary" id="email"
                                name="email" placeholder="name@example.com" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="password" class="form-label text-light fw-medium"><i
                                    class="fas fa-lock me-2 text-danger"></i> Password</label>
                            <input type="password" class="form-control bg-black text-white border-secondary" id="password"
                                name="password" placeholder="Minimum 8 characters" required>
                        </div>

                        <div class="form-group mb-4">
                            <label for="password_confirmation" class="form-label text-light fw-medium"><i
                                    class="fas fa-check-double me-2 text-danger"></i> Confirm Password</label>
                            <input type="password" class="form-control bg-black text-white border-secondary"
                                id="password_confirmation" name="password_confirmation" placeholder="Repeat password"
                                required>
                        </div>

                        <button type="submit" class="btn btn-danger btn-lg w-100 mb-3">
                            <i class="fas fa-user-plus me-2"></i> Register Account
                        </button>
                        <a href="{{ route('google.login') }}" class="btn btn-danger btn-lg w-100 mb-3">
                            <i class="fab fa-google me-2"></i>
                            Continue with Google
                        </a>
                        <div class="text-center text-secondary small">
                            Already registered? <a href="/login-view" class="text-danger text-decoration-none">Log in
                                here</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
