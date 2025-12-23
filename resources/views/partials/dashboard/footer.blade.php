<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; Toolancer {{ date('Y') }}</span>
        </div>
    </div>
</footer>

<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script>
    $('#sidebarToggleTop').on('click', function () {
        $('.sidebar').toggleClass('nav-on nav-off');
    });
</script>
