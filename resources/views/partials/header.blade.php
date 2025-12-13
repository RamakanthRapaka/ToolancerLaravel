<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="{{ asset('img/favicon.ico') }}" sizes="16x16" type="image/png">

    {{-- CSS --}}
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('font/poppins.css') }}">
    <link rel="stylesheet" href="{{ asset('css/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery.fancybox.css') }}">
    <link rel="stylesheet" href="{{ asset('css/swiper-bundle.min.css') }}">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">

    <link rel="icon" type="image/x-icon" href="{{ asset('img/favIcon.png') }}">

    {{-- Google Font --}}
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/multiSelect.css') }}">

    <title>Toolancer</title>
</head>

<body>
    {{-- Login Modal --}}
    @include('partials.login')

    <header class="header">
        <div class="container">
            <nav class="menuBar navbar-expand-lg rounded-pill p-1">
                <div class="row align-items-center">
                    <div class="col-lg-3 text-center position-relative d-lg-block d-flex bg-white">
                        <a class="navbar-brand d-block" href="{{ url('/') }}">
                            <img src="{{ asset('img/logo.png') }}" class="img-fluid w-100" />
                        </a>

                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbar">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#3083e9"
                                class="bi bi-list" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z">
                                </path>
                            </svg>
                        </button>
                    </div>

                    <div class="col-lg-9">
                        <div class="collapse navbar-collapse justify-content-end" id="navbar">
                            <ul class="navbar-nav">

                                <li class="nav-item {{ request()->is('/') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ url('/') }}">Home</a>
                                </li>

                                <li class="nav-item {{ request()->is('expert-tools*') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ url('expert-tools') }}">Tools</a>
                                </li>

                                <li class="nav-item {{ request()->is('expert-users*') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ url('expert-users') }}">Tool Expert</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link arrowLink text-white" data-bs-toggle="offcanvas"
                                        href="#loginslide">
                                        Sign Up
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link arrowLink text-white" href="{{ url('admin/login') }}">
                                        Login
                                    </a>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </header>
