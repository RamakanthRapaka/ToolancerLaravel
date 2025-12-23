@extends('layouts.auth')

@section('content')
<div class="login-page">
    <div class="container h-100">
        <div class="row justify-content-center h-100">
            <div class="col-sm-4 m-auto">
                <div class="card border-0 my-5">
                    <div class="card-body p-0">
                        <div class="p-5">

                            <div class="text-center mb-4">
                                <a class="navbar-brand d-block mb-2" href="{{ url('/') }}">
                                    <img src="{{ asset('img/logo.png') }}" class="img-fluid w-100" />
                                </a>
                                <h5 class="text-gray-900 mb-4">Welcome Back!</h5>
                            </div>

                            {{-- Message --}}
                            <div class="login-message alert d-none"></div>

                            {{-- Login Form --}}
                            <form id="loginForm" method="POST" action="{{ route('login') }}" novalidate>
                                @csrf

                                <div class="form-group mb-3">
                                    <input type="email" name="email" class="form-control"
                                        placeholder="Enter Email Address..." required>
                                    <div class="invalid-feedback">Email is required</div>
                                </div>

                                <div class="form-group mb-3">
                                    <input type="password" name="password" class="form-control"
                                        placeholder="Password" required>
                                    <div class="invalid-feedback">Password is required</div>
                                </div>

                                <button type="submit" class="btn btn-primary w-100">
                                    Login
                                </button>
                            </form>

                        </div>
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
