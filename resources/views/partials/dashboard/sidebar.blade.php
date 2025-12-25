<div class="sidebar nav-off">
    <ul class="navbar-nav accordion" id="accordionSidebar">

        {{-- Brand --}}
        <a class="navbar-brand d-lg-block d-none bg-white p-2" href="{{ route('dashboard') }}">
            <img src="{{ asset('img/logo.png') }}" class="img-fluid" />
        </a>

        {{-- Dashboard --}}
        <li class="nav-item active">
            <a class="nav-link" href="{{ route('dashboard') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
            <hr class="sidebar-divider my-0">
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('toolgrid.index') }}">
                <span>Categories</span>
            </a>
        </li>

        <hr class="sidebar-divider my-0">

        <li class="nav-item">
            <a class="nav-link" href="{{ route('toolupload.index') }}">
                <span>Tool Upload</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('users.index') }}">
                <span>User Profile</span>
            </a>
        </li>

    </ul>
</div>
