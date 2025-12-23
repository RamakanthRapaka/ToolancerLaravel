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

</body>
</html>
