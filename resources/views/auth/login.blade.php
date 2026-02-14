@extends('layouts.auth')

@section('content')
    <div class="login-page">
        <div class="container h-100">
            <div class="row justify-content-center h-100">
                <div class="col-sm-4 m-auto">
                    <div class="card border-0 my-5">
                        <div class="card-body p-5">

                            <div class="text-center mb-4">
                                <img src="{{ asset('img/logo.png') }}" class="img-fluid mb-3">
                                <h5>Welcome Back!</h5>
                            </div>

                            {{-- ✅ SUCCESS MESSAGE (PLACE HERE) --}}
                            @if (session('status'))
                                <div class="alert alert-success text-center">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <div class="login-message alert d-none"></div>

                            <form id="loginForm" method="POST" action="{{ route('login.submit') }}" novalidate>
                                @csrf

                                <div class="mb-3">
                                    <input type="email" name="email" class="form-control" placeholder="Email" required>
                                    <div class="invalid-feedback">Email required</div>
                                </div>

                                <div class="mb-2">
                                    <input type="password" name="password" class="form-control" placeholder="Password"
                                        required>
                                    <div class="invalid-feedback">Password required</div>
                                </div>

                                <!-- Forgot Password Link -->
                                <div class="mb-3 text-center">
                                    <a href="{{ route('password.request') }}" class="small text-decoration-none">
                                        Forgot Password?
                                    </a>
                                </div>

                                <button class="btn btn-primary w-100">
                                    Login
                                </button>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/login-ajax.js') }}"></script>
@endpush
