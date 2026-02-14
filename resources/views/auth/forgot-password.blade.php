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
                            <h5>Forgot Password</h5>
                            <p class="text-muted small">
                                Enter your email to receive reset link
                            </p>
                        </div>

                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf

                            <div class="mb-3">
                                <input type="email" name="email"
                                       class="form-control"
                                       placeholder="Email" required>
                            </div>

                            <button class="btn btn-primary w-100">
                                Send Reset Link
                            </button>

                            <div class="text-center mt-3">
                                <a href="{{ route('login') }}"
                                   class="small text-decoration-none">
                                    Back to Login
                                </a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('js/forgot-password-ajax.js') }}"></script>
@endpush
