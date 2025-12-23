<div class="header">
    <nav class="navbar navbar-expand d-flex">

        <button id="sidebarToggleTop" class="btn btn-link nav-off rounded-circle mr-3"><svg
                xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="#0b5ed7" class="bi bi-list"
                viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                    d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5" />
            </svg></button>

        <a class="navbar-brand d-lg-none d-block bg-white col-md-2 col-3 py-2" href="{{ route('dashboard') }}">
            <img src="{{ asset('img/logo.png') }}" class="img-fluid" />
        </a>

        <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown">
                <button class="btn dropdown-toggle" data-bs-toggle="dropdown">
                    <span class="me-2">{{ auth()->user()->name }}</span>
                    <img class="img-profile rounded-circle" width="32" src="{{ asset('img/undraw_profile.svg') }}">
                </button>

                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="#">
                            Profile
                        </a>
                    </li>

                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="dropdown-item text-danger">
                                Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
</div>
