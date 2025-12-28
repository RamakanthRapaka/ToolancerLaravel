$(document).ready(function () {

    let search = '';

    function loadExperts() {
        $.get(window.EXPERT_AJAX_URL, {
            search: search
        }, function (res) {
            $('#expertsContainer').html(res.html);
        });
    }

    // Initial load
    loadExperts();

    // Search (debounced)
    let timer;
    $('.search-input').on('keyup', function () {
        clearTimeout(timer);
        search = this.value;
        timer = setTimeout(loadExperts, 400);
    });

});
