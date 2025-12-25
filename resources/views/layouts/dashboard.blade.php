<!DOCTYPE html>
<html lang="en">
<head>
    @include('partials.dashboard.head')
</head>
<body id="page-top">

<div class="d-flex">
    <div>
        @include('partials.dashboard.sidebar')
    </div>

    <div class="w-100">
        @include('partials.dashboard.header')

        <div class="content-body">
            @yield('content')
        </div>

        @include('partials.dashboard.footer')
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>

@stack('scripts')
</body>
</html>
