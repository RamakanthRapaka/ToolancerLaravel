
$(document).ready(function () {
    let category = 'all';
    let search   = '';

    function loadTools() {
        $.get(window.TOOL_AJAX_URL, {
            category: category,
            search: search
        }, function (res) {
            $('#toolsContainer').html(res.html);
        });
    }

    // Initial load
    loadTools();

    // Category click
    $('.tabsForservice').on('click', 'li', function () {
        $('.tabsForservice li').removeClass('active');
        $(this).addClass('active');

        category = $(this).data('category'); // ✅ CORRECT
        loadTools();
    });

    // Search (debounced)
    let timer;
    $('.search-input').on('keyup', function () {
        clearTimeout(timer);
        search = this.value;
        timer = setTimeout(loadTools, 400);
    });

});