<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.auth-head')
</head>

<body id="page-top">
    @yield('content')

    {{-- JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>

</html>
