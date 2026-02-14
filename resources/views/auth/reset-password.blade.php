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
                            <h5>Reset Password</h5>
                        </div>

                        {{-- ERROR MESSAGE --}}
                        @if ($errors->any())
                            <div class="alert alert-danger text-center">
                                {{ $errors->first() }}

                                <div class="mt-2">
                                    <a href="{{ route('password.request') }}">
                                        Request new reset link
                                    </a>
                                </div>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf

                            <input type="hidden" name="token" value="{{ $token }}">

                            <div class="mb-3">
                                <input type="email" name="email"
                                       class="form-control"
                                       value="{{ $email ?? old('email') }}"
                                       placeholder="Email" required>
                            </div>

                            <div class="mb-3">
                                <input type="password" name="password"
                                       class="form-control"
                                       placeholder="New Password" required>
                            </div>

                            <div class="mb-3">
                                <input type="password"
                                       name="password_confirmation"
                                       class="form-control"
                                       placeholder="Confirm Password" required>
                            </div>

                            <button class="btn btn-primary w-100">
                                Reset Password
                            </button>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
