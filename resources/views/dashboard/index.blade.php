@extends('layouts.dashboard')

@section('content')

<div class="page_title">
    <h1>Dashboard</h1>
    <h2>Welcome {{ auth()->user()->name }}</h2>
</div>

<div class="right_body-conent">
    <div class="cardCategory">
        <div class="row py-3">

            {{-- Total Tools --}}
            <div class="col-md-3 mb-3">
                <div class="card border-left shadow h-100 py-2">
                    <div class="card-body">
                        <div class="text-xs font-weight-bold text-primary mb-1">
                            Total Tools
                        </div>
                        <div class="h5 fw-bold">
                            {{ $stats['total_tools'] }}
                        </div>
                    </div>
                </div>
            </div>

            {{-- Total Users --}}
            <div class="col-md-3 mb-3">
                <div class="card border-left shadow h-100 py-2">
                    <div class="card-body">
                        <div class="text-xs font-weight-bold text-primary mb-1">
                            Total Users
                        </div>
                        <div class="h5 fw-bold">
                            {{ $stats['total_users'] }}
                        </div>
                    </div>
                </div>
            </div>

            {{-- Total Active --}}
            <div class="col-md-3 mb-3">
                <div class="card border-left shadow h-100 py-2">
                    <div class="card-body">
                        <div class="text-xs font-weight-bold text-primary mb-1">
                            Total Active
                        </div>
                        <div class="h5 fw-bold">
                            {{ $stats['total_active'] }}
                        </div>
                    </div>
                </div>
            </div>

            {{-- Total Rejected --}}
            <div class="col-md-3 mb-3">
                <div class="card border-left shadow h-100 py-2">
                    <div class="card-body">
                        <div class="text-xs font-weight-bold text-primary mb-1">
                            Total Rejected
                        </div>
                        <div class="h5 fw-bold">
                            {{ $stats['total_rejected'] }}
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
