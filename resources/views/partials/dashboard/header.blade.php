<div class="header">
    <nav class="navbar navbar-expand d-flex">

        <button id="sidebarToggleTop" class="btn btn-link nav-off rounded-circle mr-3">
            ☰
        </button>

        <a class="navbar-brand d-lg-none d-block bg-white col-md-2 col-3 py-2" href="{{ route('dashboard') }}">
            <img src="{{ asset('img/logo.png') }}" class="img-fluid" />
        </a>

        <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown">
                <button class="btn dropdown-toggle" data-bs-toggle="dropdown">
                    <span class="me-2">{{ auth()->user()->name }}</span>
                    <img class="img-profile rounded-circle" width="32"
                         src="{{ asset('img/undraw_profile.svg') }}">
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
